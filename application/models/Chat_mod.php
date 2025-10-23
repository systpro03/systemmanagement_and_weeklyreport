<?php
class Chat_mod extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function getAllUsers()
    {
        $this->db->select('*');
        $this->db->where('emp_id !=', $this->session->userdata('emp_id'));
        $this->db->where('type', 'Fulltime');
        $this->db->where('is_active', 'Active');

        $data = $this->db->get('users');
        if ($data->num_rows() > 0) {
            return $data->result_array();
        } else {
            return false;
        }
    }

public function get_messages($user_id = null, $receiver_id = null)
{
    $this->db->select('
        m.id,
        m.sender_id,
        m.receiver_id,
        m.message,
        m.attachments,
        m.date_send,
        m.reaction,
        m.reply_to,
        r.message AS replied_message,
        r.sender_id AS reply_user_id
    ');
    $this->db->from('messages m');
    $this->db->join('messages r', 'm.reply_to = r.id', 'left'); // 👈 self join

    $this->db->order_by('m.date_send', 'ASC');
    $this->db->group_start();
    $this->db->where('m.sender_id', $user_id);
    $this->db->where('m.receiver_id', $receiver_id);
    $this->db->group_end();
    $this->db->or_group_start();
    $this->db->where('m.sender_id', $receiver_id);
    $this->db->where('m.receiver_id', $user_id);
    $this->db->group_end();

    return $this->db->get()->result();
}


    public function getLastMessage($receiver_id)
    {
        $user_id = $this->session->userdata("emp_id"); // Logged-in user

        $this->db->select('message, date_send, sender_id, receiver_id');
        $this->db->from('messages');
        $this->db->group_start();
        $this->db->where('sender_id', $user_id);
        $this->db->where('receiver_id', $receiver_id);
        $this->db->group_end();
        $this->db->or_group_start();
        $this->db->where('sender_id', $receiver_id);
        $this->db->where('receiver_id', $user_id);
        $this->db->group_end();
        $this->db->order_by('date_send', 'DESC');
        $this->db->limit(1);

        $query = $this->db->get();
        return $query->result_array(); // Returns the last message as an array
    }


    public function fetch_new_messages($user_id, $receiver_id, $last_message_id)
    {
        $this->db->select('*');
        $this->db->from('messages');
        $this->db->group_start();
        $this->db->where('sender_id', $user_id);
        $this->db->where('receiver_id', $receiver_id);
        $this->db->group_end();
        $this->db->or_group_start();
        $this->db->where('sender_id', $receiver_id);
        $this->db->where('receiver_id', $user_id);
        $this->db->group_end();
        $this->db->order_by('date_send', 'ASC');

        $query = $this->db->get();

        return $query->result_array();
    }


    public function send_message($data)
    {
        return $this->db->insert('messages', $data);
    }

    public function mark_messages_as_seen($user_id, $sender_id)
    {
        $this->db->set('seen', 'Yes');
        $this->db->where('receiver_id', $user_id);
        $this->db->where('sender_id', $sender_id);
        return $this->db->update('messages');
    }

    public function get_attachments($message_id)
    {
        $this->db->select('attachments');
        $this->db->from('messages');
        $this->db->where('id', $message_id);
        $query = $this->db->get();

        return array_column($query->result_array(), 'attachments'); // returns array of filenames
    }
    public function get_total_unseen($emp_id)
    {
        $this->db->where('receiver_id', $emp_id);
        $this->db->where("(seen != 'Yes' OR seen IS NULL OR seen = '')");

        return $this->db->count_all_results('messages');
    }
    public function save_reaction($message_id, $user_id, $reaction) {
        $current = $this->db->where('id', $message_id)
                            ->get('messages')
                            ->row()->reaction;

        if ($reaction == $current) {
            // Remove reaction
            $this->db->update('messages', ['reaction' => null], ['id' => $message_id]);
            return null;
        } else {
            // Save new reaction
            $this->db->update('messages', ['reaction' => $reaction], ['id' => $message_id]);
            return $reaction;
        }
    }

    public function get_unseen_messages($user_id, $sender_id) {
        $this->db->where('receiver_id', $user_id);
        $this->db->where('sender_id', $sender_id);
        $this->db->where("(seen != 'Yes' OR seen IS NULL OR seen = '')");
        return $this->db->get('messages')->result_array();
    }

    public function get_message_by_id($id)
    {
        return $this->db->where('id', $id)->get('messages')->row();
    }
 public function get_user_groups($user_id)
    {
        // Fetch all groups the user belongs to
        $this->db->select('g.group_id, g.group_name');
        $this->db->from('chat_group_members gm');
        $this->db->join('chat_groups g', 'g.group_id = gm.group_id');
        $this->db->where('gm.emp_id <>', $user_id);
        $this->db->order_by('g.group_name', 'ASC');
        $groups = $this->db->get()->result_array();

        $result = [];

        foreach ($groups as $g) {
            $group_id = $g['group_id'];

            // Get latest message for this group
            $this->db->select('*');
            $this->db->from('messages');
            $this->db->where('group_id', $group_id);
            $this->db->order_by('id', 'DESC');
            $this->db->limit(1);
            $msg = $this->db->get()->row_array();

            // Count unseen messages for this user
            $this->db->from('messages');
            $this->db->where('group_id', $group_id);
            $this->db->where('sender_id', $user_id);
            $this->db->where('seen !=', 'Yes');
            $unseen = $this->db->count_all_results();

            $result[] = [
                'group_id'      => $group_id,
                'group_name'    => $g['group_name'],
                'last_message'  => isset($msg['message']) ? $msg['message'] : null,
                'last_time'     => isset($msg['created_at']) ? date('h:i A', strtotime($msg['created_at'])) : null,
                'unseen_count'  => $unseen
            ];
        }

        return $result;
    }
    public function delete_conversation($emp_id)
    {
        $user_id = $this->session->userdata('emp_id');

        $this->db->group_start();
        $this->db->where('sender_id', $user_id);
        $this->db->where('receiver_id', $emp_id);
        $this->db->group_end();
        $this->db->or_group_start();
        $this->db->where('sender_id', $emp_id);
        $this->db->where('receiver_id', $user_id);
        $this->db->group_end();

        return $this->db->delete('messages');
    }
}