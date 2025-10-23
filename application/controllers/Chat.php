<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Chat extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if ($this->session->username == "") {
            redirect('login');
        }
        $this->load->model('Chat_mod', 'chat');
        $this->load->model('Menu/Workload', 'workload');
        $this->load->model('Menu/Structure_mod', 'structure');
    }

    public function index()
    {
        $this->load->view('_layouts/header');
        $this->load->view('menu/chats');
        $this->load->view('_layouts/footer');
    }

    public function get_users()
    {
        $session_id = $_SESSION['emp_id'];
        $users = $this->chat->getAllUsers();
        $data = [];

        foreach ($users as $value) {
            $emp_data = $this->workload->get_emp($value['emp_id']);
            $emp_dat = $this->structure->get_emp($value['emp_id']);
            $this->db->select('*');
            $this->db->where("(sender_id = '$session_id' AND receiver_id = '{$value['emp_id']}') OR 
                               (sender_id = '{$value['emp_id']}' AND receiver_id = '$session_id')");
            $this->db->order_by('date_send', 'DESC');
            $this->db->limit(1);
            $last_message = $this->db->get('messages')->row_array();

            if (!$last_message['seen']) {
                $seen = 'No';
            } else {
                $seen = 'Yes';
            }

            $this->db->where('receiver_id', $session_id);
            $this->db->where('sender_id', $value['emp_id']);
            $this->db->where("(seen != 'Yes' OR seen IS NULL OR seen = '')");
            $unseen_count = $this->db->count_all_results('messages');

            $data[] = [
                'id' => $value['id'],
                'emp_id' => $value['emp_id'],
                'sender_id' => $last_message ? $last_message['sender_id'] : null,
                'name' => ucwords(strtolower($emp_data['name'])),
                'last_message' => $last_message ? $last_message['message'] : '',
                'last_time' => $last_message ? date('h:i A', strtotime($last_message['date_send'])) : '',
                'has_messages' => $last_message ? 1 : 0,
                'unseen_count' => $unseen_count,
                'photo' => ltrim($emp_dat['photo'], '.'),
                'seen' => $seen,
                'attachments' => $last_message ? json_decode($last_message['attachments'], true) : [],
                'date_send' => $last_message ? $last_message['date_send'] : null,
            ];
        }
        usort($data, function ($a, $b) {
            return strcmp($a['name'], $b['name']);
        });
        echo json_encode($data);
    }

    public function get_messages()
    {
        $user_id = $this->session->userdata('emp_id');
        $receiver_id = $this->input->post('receiver_id');

        $messages = $this->chat->get_messages($user_id, $receiver_id);

        foreach ($messages as &$msg) {
            $emp = $this->structure->get_emp($msg->sender_id);
            $msg->photo = ltrim($emp['photo'], '.');
            $attachments = $this->chat->get_attachments($msg->id);
            $msg->attachments = $attachments ?: [];
            if (!empty($msg->reply_to)) {
                $parent = $this->chat->get_message_by_id($msg->reply_to);

                if ($parent) {
                    $msg->replied_message = $parent->message;
                    $parent_emp = $this->structure->get_emp($parent->receiver_id);
                    $msg->receiver_name = $parent_emp['name'] ?: "Unknown";
                }
            }
        }

        echo json_encode($messages);
    }




    public function get_new_messages()
    {
        $user_id = $this->session->userdata("emp_id");
        $receiver_id = $this->input->post('receiver_id');
        $last_message_id = $this->input->post('last_message_id');

        $new_messages = $this->chat->fetch_new_messages($user_id, $receiver_id, $last_message_id);


        $sender = $this->structure->get_emp($user_id);
        $receiver = $this->structure->get_emp($receiver_id);


        $sender_photo = ltrim($sender['photo'], '.');
        $receiver_photo = ltrim($receiver['photo'], '.');


        foreach ($new_messages as &$msg) {
            if ($msg['sender_id'] == $user_id) {
                $msg['photo'] = $sender_photo;
            } else {
                $msg['photo'] = $receiver_photo;
            }
        }

        echo json_encode($new_messages);
    }

    public function send_message()
    {
        $sender_id = $this->session->userdata('emp_id');
        $receiver_id = $this->input->post('receiver_id');
        $message = $this->input->post('message', TRUE);
        $reply_to = $this->input->post('reply_to');

        $attachments = [];

        if (!empty($_FILES['attachments']['name'][0])) {

            $filesCount = count($_FILES['attachments']['name']);

            for ($i = 0; $i < $filesCount; $i++) {

                $_FILES['file'] = [
                    'name' => $_FILES['attachments']['name'][$i],
                    'type' => $_FILES['attachments']['type'][$i],
                    'tmp_name' => $_FILES['attachments']['tmp_name'][$i],
                    'error' => $_FILES['attachments']['error'][$i],
                    'size' => $_FILES['attachments']['size'][$i]
                ];

                $config['upload_path'] = './assets/uploads/chat_files/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|doc|docx|xls|xlsx|txt';
                $config['encrypt_name'] = FALSE;
                $originalName = $_FILES['attachments']['name'][$i];
                $safeName = str_replace(' ', '_', $originalName);
                $config['file_name'] = $safeName;

                if (!is_dir($config['upload_path'])) {
                    mkdir($config['upload_path'], 0777, TRUE);
                }

                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if ($this->upload->do_upload('file')) {
                    $uploadedData = $this->upload->data();

                    $filePath = $uploadedData['file_name'];
                    $attachments[] = $filePath;
                } else {
                    echo json_encode([
                        'status' => 'error',
                        'message' => $this->upload->display_errors()
                    ]);
                    return;
                }
            }
        }

        $data = [
            'sender_id' => $sender_id,
            'receiver_id' => $receiver_id,
            'message' => $message,
            'attachments' => json_encode($attachments),
            'reply_to' => !empty($reply_to) ? $reply_to : null,
            'date_send' => date('Y-m-d H:i:s')
        ];

        $insert_id = $this->chat->send_message($data);

        $replied_message = null;
        $reply_user = null;
        if (!empty($reply_to)) {
            $original = $this->chat->get_message_by_id($reply_to);
            if ($original) {
                $replied_message = $original->message;
                $reply_user = $original->sender_id;
            }
        }

        echo json_encode([
            'status' => 'success',
            'id' => $insert_id,
            'message' => $message,
            'attachments' => $attachments,
            'date_send' => $data['date_send'],
            'reply_to' => $reply_to,
            'replied_message' => $replied_message,
            'reply_user' => $reply_user
        ]);
    }

    public function mark_seen()
    {
        $user_id = $this->session->userdata("emp_id");
        $sender_id = $this->input->post('sender_id');

        $this->chat->mark_messages_as_seen($user_id, $sender_id);
    }

    public function message_unseen()
    {
        $emp_id = $this->session->userdata('emp_id');
        $total = $this->chat->get_total_unseen($emp_id); // your query
        echo json_encode(['total' => $total]);
    }

    public function save_reaction()
    {
        $message_id = $this->input->post('message_id');
        $user_id = $this->input->post('user_id');
        $reaction = $this->input->post('reaction');

        $result = $this->chat->save_reaction($message_id, $user_id, $reaction);

        if ($result !== false) {
            echo json_encode([
                "status" => "success",
                "message" => "Reaction saved",
                "reaction" => $result,
                "reaction_user_id" => $user_id
            ]);
        } else {
            echo json_encode([
                "status" => "error",
                "message" => "Failed to save reaction"
            ]);
        }
    }

    public function create_group()
    {
        $group_name = $this->input->post('group_name');
        $members = $this->input->post('members');
        $creator = $this->session->userdata('emp_id');

        $this->db->insert('chat_groups', [
            'group_name' => $group_name,
            'created_by' => $creator,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        $group_id = $this->db->insert_id();

        foreach ($members as $member) {
            $this->db->insert('chat_group_members', [
                'group_id' => $group_id,
                'emp_id' => $member,
                'joined_at' => date('Y-m-d H:i:s')
            ]);
        }

        echo json_encode(['status' => 'success', 'group_id' => $group_id]);
    }

    public function send_group_message()
    {
        $group_id = $this->input->post('group_id');
        $message = $this->input->post('message');
        $sender_id = $this->session->userdata('emp_id');

        $data = [
            'sender_id' => $sender_id,
            'group_id' => $group_id,
            'message' => $message,
            'date_send' => date('Y-m-d H:i:s')
        ];

        $this->db->insert('chat_messages', $data);

        $members = $this->db->select('emp_id')
            ->from('chat_group_members')
            ->where('group_id', $group_id)
            ->where('emp_id !=', $sender_id)
            ->get()->result_array();

        echo json_encode([
            'status' => 'success',
            'group_id' => $group_id,
            'members' => array_column($members, 'emp_id')
        ]);
    }


    public function get_group_messages()
    {
        $group_id = $this->input->post('group_id');

        $query = $this->db->select('m.*,u.*')
            ->from('messages m')
            ->join('users u', 'u.emp_id = m.sender_id')
            ->where('m.group_id', $group_id)
            ->order_by('m.date_send', 'ASC')
            ->get();

        echo json_encode($query->result());
    }

    public function get_groups()
    {
        $user_id = $this->session->userdata('emp_id');
        if (empty($user_id)) {
            echo json_encode([]);
            return;
        }
        $groups = $this->chat->get_user_groups($user_id);

        echo json_encode($groups);
    }

    public function delete_chat()
    {
        $emp_id = $this->input->post('emp_id');
        $current_user = $this->session->userdata('emp_id');
        $this->chat->delete_conversation($emp_id);
        $socketData = [
            'sender_id' => $current_user,
            'receiver_id' => $emp_id
        ];

        $this->socket_bridge_notify('conversationDeleted', $socketData);

        echo json_encode(['success' => true]);
    }

    // Socket bridge
    private function socket_bridge_notify($event, $data)
    {
        $ch = curl_init('http://172.16.42.144:3000/emit');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(['event' => $event, 'data' => $data]));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_exec($ch);
        curl_close($ch);
    }
}