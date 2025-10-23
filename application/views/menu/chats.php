<style>
    /* Time below message */
    .chat-time {
        font-size: 11px;
        color: #888;
        margin-top: 4px;
        text-align: right;
    }

    #attach-btn,
    #emoji-btn,
    .chat-input-section button[type="submit"] {
        border-radius: 50%;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* === Chat List (Messenger Style) === */
    .chat-user-list {
        margin: 0;
        padding: 0;
    }

    .chat-user-item {
        padding: 10px 14px;
        border-radius: 12px;
        transition: 0.2s;
        cursor: pointer;
        display: block;
    }

    .chat-user-item:hover {
        /* background: #f0f2f5; */
    }

    .chat-user-item.active {
        /* background: #e7f3ff; */
        border-left: 4px solid #1877f2;
    }

    /* Avatar */
    .chat-user-img img {
        width: 48px;
        height: 48px;
        object-fit: cover;
        border-radius: 50% !important;
        border: 2px solid #e4e6eb;
    }

    /* User name */
    .chat-user-item .fw-bold {
        font-size: 14px !important;
        color: #050505;
        margin-bottom: 2px;
    }

    /* Last message preview */
    .chat-user-item p {
        font-size: 10px;
        color: #65676b;
        margin: 0;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    /* Timestamp & unread */
    .chat-user-item .text-end {
        font-size: 11px;
        color: #8d949e;
    }

    .chat-user-item .badge {
        font-size: 11px;
        padding: 3px 6px;
    }

    .big-emoji {
        font-size: 3rem;
        /* Bigger than normal text */
        line-height: 1.2;
        display: inline-block;
    }

    /* Reaction bar container */
    .emoji-bar {
        display: flex;
        justify-content: center;
        align-items: center;
        background: #fff;
        /* white background */
        border-radius: 40px;
        /* pill shape */
        padding: 8px 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
        /* subtle shadow */
        gap: 8px;
    }

    /* Emoji circle button */
    .emoji-circle {
        font-size: 26px;
        width: 46px;
        height: 46px;
        border-radius: 50%;
        /* circle */
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: transform 0.2s, box-shadow 0.2s;
        background: #f5f5f5;
        /* default gray background */
    }

    /* Hover effect (Messenger-style pop) */
    .emoji-circle:hover {
        transform: scale(1.3);
        /* bigger when hovered */
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    }

    /* Active (click press) */
    .emoji-circle:active {
        transform: scale(1.1);
    }

    /* OPTIONAL: Assign background colors to match Messenger */
    .emoji-circle[data-emoji="👍"] {
        background: #1877f2;
        color: #fff;
    }

    .emoji-circle[data-emoji="❤️"] {
        background: #f02849;
        color: #fff;
    }

    .emoji-circle[data-emoji="😂"] {
        background: #ffda6a;
    }

    .emoji-circle[data-emoji="😮"] {
        background: #ffda6a;
    }

    .emoji-circle[data-emoji="😢"] {
        background: #ffda6a;
    }

    .emoji-circle[data-emoji="😡"] {
        background: #e4605e;
        color: #fff;
    }

    @keyframes bounce {

        0%,
        80%,
        100% {
            transform: scale(0);
        }

        40% {
            transform: scale(1);
        }
    }
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-lg-flex gap-3">
                        <div class="chat-leftsidebar">
                            <div class="px-4 pt-4 mb-4">
                                <div class="d-flex align-items-start">
                                    <div class="flex-grow-1">
                                        <h5 class="mb-4">Chats </h5>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <div data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="bottom"
                                            title="Add Contact">

                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-soft-success btn-sm shadow-none">
                                                <i class="ri-add-line align-bottom"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="search-box">
                                    <input type="text" class="form-control bg-light border-light" id="searchUser"
                                        placeholder="Search you wanted to chat here..." />
                                    <i class="ri-search-2-line search-icon"></i>
                                </div>

                            </div> <!-- .p-4 -->

                            <ul class="nav nav-tabs nav-tabs-custom nav-success nav-justified" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#chats" role="tab">
                                        Chats
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#contacts" role="tab">
                                        Contacts
                                    </a>
                                </li>
                            </ul>

                            <div class="tab-content text-muted">
                                <div class="tab-pane active" id="chats" role="tabpanel">
                                    <div class="chat-room-list pt-3" data-simplebar="">
                                        <div class="" id="userList">
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="contacts" role="tabpanel">
                                    <div class="chat-room-list pt-3" data-simplebar="">
                                        <div class="sort-contact">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end tab contact -->
                        </div>
                        <div class="user-chat w-100 overflow-hidden">
                            <div class="chat-content d-lg-flex">
                                <div class="w-100 overflow-hidden position-relative">
                                    <div class="position-relative">
                                        <div class="position-relative" id="users-chat">
                                            <div class="p-3 user-chat-topbar">
                                                <div class="row align-items-center">
                                                    <div class="col-sm-4 col-8">
                                                        <div class="d-flex align-items-center">
                                                            <div class="flex-shrink-0 d-block d-lg-none me-3">
                                                                <a href="javascript: void(0);"
                                                                    class="user-chat-remove fs-18 p-1"><i
                                                                        class="ri-arrow-left-s-line align-bottom"></i></a>
                                                            </div>
                                                            <div class="flex-grow-1 overflow-hidden">
                                                                <div class="d-flex align-items-center">
                                                                    <div
                                                                        class="flex-shrink-0 chat-user-img online user-own-img align-self-center me-3 ms-0">
                                                                        <span class="user-status"></span>
                                                                    </div>
                                                                    <div
                                                                        class="d-flex justify-content-between align-items-center">
                                                                        <div class="flex-shrink-0 chat-user-img mt-1">
                                                                            <img id="profile_photo"
                                                                                class="img-thumbnail avatar-sm rounded-circle"
                                                                                style="border-color: orange; display: none">
                                                                        </div>&nbsp;&nbsp;
                                                                        <h5 class="text-truncate mb-0 fs-11 gap-1">
                                                                            <a class="text-reset username"></a>
                                                                        </h5>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-8 col-4">
                                                        <ul class="list-inline user-chat-nav text-end mb-0">
                                                            <li class="list-inline-item m-0">
                                                                <div class="dropdown">
                                                                    <button
                                                                        class="btn btn-sm btn-ghost-secondary btn-icon shadow-none"
                                                                        type="button" data-bs-toggle="dropdown"
                                                                        aria-haspopup="true" aria-expanded="false">
                                                                        <iconify-icon icon="wpf:search" width="20"
                                                                            height="20"></iconify-icon>
                                                                    </button>
                                                                    <div
                                                                        class="dropdown-menu p-0 dropdown-menu-end dropdown-menu-lg">
                                                                        <div class="p-2">
                                                                            <div class="search-box">
                                                                                <input type="text"
                                                                                    class="form-control bg-light border-light"
                                                                                    placeholder="Search here..."
                                                                                    onkeyup="searchMessages()"
                                                                                    id="searchMessage" />
                                                                                <i
                                                                                    class="ri-search-2-line search-icon"></i>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>

                                                            <li class="list-inline-item m-0">
                                                                <div class="dropdown">
                                                                    <button
                                                                        class="btn btn-sm btn-ghost-secondary btn-icon shadow-none"
                                                                        type="button" data-bs-toggle="dropdown"
                                                                        aria-haspopup="true" aria-expanded="false">
                                                                        <iconify-icon icon="pepicons-pop:dots-y"
                                                                            width="25" height="25"></iconify-icon>
                                                                    </button>
                                                                    <div class="dropdown-menu dropdown-menu-end">
                                                                        <a class="dropdown-item d-block d-lg-none user-profile-show"
                                                                            href="#"><i
                                                                                class="ri-user-2-fill align-bottom text-muted me-2"></i>
                                                                            View Profile </a>
                                                                        <a class="dropdown-item" href="#"><i
                                                                                class="ri-inbox-archive-line align-bottom text-muted me-2"></i>
                                                                            Archive </a>
                                                                        <a class="dropdown-item" href="#"><i
                                                                                class="ri-mic-off-line align-bottom text-muted me-2"></i>
                                                                            Muted </a>
                                                                        <a class="dropdown-item" href="#"><i
                                                                                class="ri-delete-bin-5-line align-bottom text-muted me-2"></i>
                                                                            Delete </a>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="chat-conversation p-3 p-lg-4" id="chat-conversation"
                                                data-simplebar="">
                                                <ul class="list-unstyled chat-conversation-list"
                                                    id="users-conversation">
                                                    <div id="defaultChatMessage" class="text-center">
                                                        <iconify-icon icon="fluent-color:chat-more-24" width="200"
                                                            height="90"></iconify-icon>
                                                        <p class="text-muted mt-3">Search a user to start
                                                            conversation...</p>
                                                    </div>
                                                </ul>
                                                <div id="typing-indicator" class="text-muted fst-italic"></div>
                                            </div>
                                        </div>
                                        <div class="chat-input-section p-3 p-lg-4 mt-3">
                                            <form id="chatinput-form" enctype="multipart/form-data">
                                                <div class="row g-0 align-items-center">
                                                    <div class="col-auto">
                                                        <div class="chat-input-links me-2">
                                                            <div class="links-list-item">
                                                                <button type="button"
                                                                    class="btn btn-secondary waves-effect waves-light shadow emoji-btn"
                                                                    id="emoji-btn">
                                                                    <i class="bx bx-smile align-middle"></i>
                                                                </button>
                                                                <div id="emoji-picker" style="display: none;"></div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col">
                                                        <div class="chat-input-feedback">Please Enter a Message</div>
                                                        <input type="text"
                                                            class="form-control chat-input bg-light border-light"
                                                            id="chat-input" placeholder="Type your message..."
                                                            autocomplete="off" />
                                                        <input type="hidden" class="form-control bg-light border-light"
                                                            id="receiver_id" autocomplete="off" name="receiver_id" />
                                                        <input type="hidden" class="form-control bg-light border-light"
                                                            id="reply_to_message_id" autocomplete="off"
                                                            name="reply_to_message_id" />
                                                    </div>

                                                    <!-- Attachment Icon -->
                                                    <div class="col-auto ms-2">
                                                        <input type="file" id="chat-attachment" name="attachments[]"
                                                            multiple
                                                            accept=".jpg,.jpeg,.png,.pdf,.doc,.docx,.xls,.xlsx,.txt"
                                                            style="display: none;" />
                                                        <button type="button"
                                                            class="btn btn-info waves-effect waves-light shadow"
                                                            id="attach-btn" title="Attach a file">
                                                            <i class="bx bx-paperclip align-middle fs-16"></i>
                                                        </button>
                                                        <span id="attachment-count"
                                                            class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                                                            style="font-size: 0.65rem; display: none;">0</span>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="chat-input-links ms-2">
                                                            <div class="links-list-item">
                                                                <button type="submit"
                                                                    class="btn btn-primary waves-effect waves-light shadow">
                                                                    <i class="ri-send-plane-2-fill align-bottom"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="replyCard">
                                            <div class="card mb-0">
                                                <div class="card-body py-3">
                                                    <div class="replymessage-block mb-0 d-flex align-items-start">
                                                        <div class="flex-grow-1">
                                                            <h5 class="conversation-name"></h5>
                                                            <p class="mb-0" />
                                                        </div>
                                                        <div class="flex-shrink-0">
                                                            <button type="button" id="close_toggle"
                                                                class="btn btn-sm btn-link mt-n2 me-n3 fs-18 shadow-none">
                                                                <i class="bx bx-x align-middle"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="module">
    import { EmojiButton } from "<?php echo base_url(); ?>assets/js/emoji.js";
    document.addEventListener("DOMContentLoaded", function () {
        const picker = new EmojiButton();
        const chatInput = document.getElementById("chat-input");
        const emojiBtn = document.getElementById("emoji-btn");

        emojiBtn.addEventListener("click", function (event) {

            event.preventDefault();
            picker.togglePicker(emojiBtn);
        });

        picker.on("emoji", function (selection) {
            chatInput.value += selection.emoji;
        });
    });
</script>

<script src="http://172.16.42.144:3000/socket.io/socket.io.js"></script>
<script>
    const socket1 = io("http://172.16.42.144:3000", {
        transports: ["websocket", "polling"],
        withCredentials: true
    });

    const currentUsers = "<?php echo $this->session->userdata('emp_id'); ?>";
    const baseUrl = "<?php echo base_url(); ?>";

    let allUsers = [];
    let displayedUsers = [];
    let attachedFiles = [];

    $(document).ready(function () {
        reloadUsers();
        function reloadUsers() {
            $.ajax({
                url: '<?php echo base_url('get_users'); ?>',
                method: 'GET',
                success: function (response) {
                    allUsers = JSON.parse(response) || [];
                    allUsers.forEach(u => { u.unseen_count = u.unseen_count || 0; });
                    displayUsers(allUsers.filter(user => user.has_messages === 1));
                    displayContacts(allUsers);
                    updateUnseenCount();
                    message_unseen();
                }
            });
        }
        $("#searchUser").on("keyup", function () {
            let searchValue = $(this).val().toLowerCase().trim();
            if (searchValue === "") {
                reloadUsers();
            } else {
                displayUsers(allUsers.filter(user => user.name.toLowerCase().includes(searchValue)));
                displayContacts(allUsers.filter(user => user.name.toLowerCase().includes(searchValue)));
            }
        });


        $("#attach-btn").on("click", () => $("#chat-attachment").click());

        $("#chat-attachment").on("change", function () {
            attachedFiles = Array.from(this.files);
            const countSpan = $("#attachment-count");
            if (attachedFiles.length > 0) {
                countSpan.text(attachedFiles.length).show();
                toastr.info("Selected files: " + attachedFiles.map(f => f.name).join(", "));
            } else {
                countSpan.hide();
            }
        });

        $("#chatinput-form").submit(function (e) {
            e.preventDefault();
            let message = $("#chat-input").val().trim();
            let receiver_id = $("#receiver_id").val();
            let reply_to = $("#reply_to_message_id").val() || null;

            if (message === "" && attachedFiles.length === 0 || receiver_id === "") {

                $(this).find(`#chat-input`).each(function () {
                    let $input = $(this);
                    let isEmpty = !$input.val();

                    $input.removeClass('is-invalid');

                    if ($input.hasClass('select2-hidden-accessible')) {
                        const $select2 = $input.next('.select2-container');
                        $select2.removeClass('is-invalid');

                        if (isEmpty) {
                            $select2.addClass('is-invalid');
                        }
                    } else {
                        if (isEmpty) {
                            $input.addClass('is-invalid');
                        }
                    }
                });

                toastr.options = {
                    progressBar: true,
                    positionClass: "toast-top-left",
                    timeOut: 5000,
                    extendedTimeOut: 2000,

                };

                toastr.error(
                    `Please add a recipient and type a message or attachment...`,
                );
                return;
            }

            let formData = new FormData();
            formData.append("receiver_id", receiver_id);
            formData.append("message", message);
            formData.append("reply_to", reply_to);
            attachedFiles.forEach(file => formData.append("attachments[]", file));

            $.ajax({
                url: "<?php echo base_url('Chat/send_message'); ?>",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    let data = JSON.parse(response);
                    if (data.status === "success") {
                        socket1.emit("sendMessage", {
                            sender_id: currentUsers,
                            sender_name: "<?php echo $this->session->userdata('name'); ?>",
                            photo: "<?php echo ltrim($this->session->userdata('photo'), '.'); ?>", // 👈 add this
                            receiver_id: receiver_id,
                            receiver_name: $(".user-chat-topbar .username").text(),
                            message: data.message,
                            attachments: data.attachments,
                            time: formatTime(new Date()),
                            reply_to: reply_to,
                            replied_message: data.replied_message || "",
                        });

                        toastr.options = {
                            progressBar: true,
                            positionClass: "toast-top-left",
                            timeOut: 5000,
                            extendedTimeOut: 2000,

                        };

                        toastr.success("Message sent!");
                        $("#chat-input").val("");
                        $("#chat-attachment").val("");
                        attachedFiles = [];
                        $("#attachment-count").hide();

                        $(".replyCard").removeClass("show");
                        $("#reply_to_message_id").val("");
                    }
                    addToChatList(
                        receiver_id,
                        $(".user-chat-topbar .username").text(),
                        $("#profile_photo").attr("src"),
                        data.message,
                        new Date(),
                        data.attachments || [],
                        currentUsers
                    );
                    reloadUsers();
                }
            });

        });

        // ✅ Typing indicator
        $("#chat-input").on("input", function () {
            if ($(this).val().length > 0) {
                socket1.emit("typing", {
                    sender_id: currentUsers,
                    receiver_id: $("#receiver_id").val(),
                });
            } else {
                socket1.emit("stopTyping", {
                    sender_id: currentUsers,
                    receiver_id: $("#receiver_id").val(),
                });
            }
        });

        // Optional: stop typing when user leaves input
        $("#chat-input").on("blur", function () {
            socket1.emit("stopTyping", {
                sender_id: currentUsers,
                receiver_id: $("#receiver_id").val(),
            });
        });

        socket1.on("newMessage", function (data) {
            let activeChat = $("#receiver_id").val();
            let otherUserId = (data.sender_id == currentUsers) ? data.receiver_id : data.sender_id;

            if (!(data.sender_id == currentUsers || data.receiver_id == currentUsers)) return;

            if (activeChat == otherUserId) {
                renderMessage(data, currentUsers);
                $.post('<?php echo base_url('chat/mark_seen'); ?>', {
                    sender_id: data.sender_id,
                    receiver_id: currentUsers
                }, function () {
                    clearUnreadForUser(otherUserId);
                });

            } else {
                let userIndex = allUsers.findIndex(u => u.emp_id == otherUserId);
                if (userIndex !== -1) {
                    if (data.sender_id != currentUsers) {
                        allUsers[userIndex].unseen_count = (allUsers[userIndex].unseen_count || 0) + 1;
                        allUsers[userIndex].seen = 'No';
                    }
                    allUsers[userIndex].has_messages = 1;
                    allUsers[userIndex].last_message = (data.message && data.message.trim() !== "")
                        ? data.message
                        : (data.attachments && data.attachments.length > 0
                            ? (data.attachments.length > 1 ? "Attachments" : "Attachment")
                            : "");
                    allUsers[userIndex].last_time = data.time;

                } else {
                    allUsers.push({
                        emp_id: otherUserId,
                        name: (data.sender_id == currentUsers) ? data.name : data.name,
                        photo: (data.sender_id == currentUsers) ? data.photo : data.photo,
                        has_messages: 1,
                        last_message: (data.message && data.message.trim() !== "")
                            ? data.message
                            : (data.attachments && data.attachments.length > 0
                                ? (data.attachments.length > 1 ? "Attachments" : "Attachment")
                                : ""),

                        last_time: data.time,
                        attachments: data.attachments || [],
                        seen: (data.sender_id == currentUsers) ? 'Yes' : 'No',
                        unseen_count: (data.sender_id == currentUsers) ? 0 : 1
                    });
                }
            }
            if (!$("#searchUser").val()) {
                displayUsers(allUsers.filter(u => u.has_messages === 1));
                displayContacts(allUsers);
            }
            updateUnseenCount();
            message_unseen();
        });
    });

    function displayUsers(users) {
        let userListHtml = "";
        users.forEach(user => {
            // 🔴 Unread badge
            let unreadBadge = "";
            if (user.unseen_count > 0) {
                unreadBadge = `<span class="unseen-badge badge bg-danger rounded-pill ms-1" style="font-size: 8px;">${user.unseen_count}</span>`;
            }

            // ✅ Active chat highlighting
            let activeChat = $("#receiver_id").val();
            let lastMessageClass = "";
            if (user.unseen_count > 0 && activeChat != user.emp_id && user.sender_id != currentUsers) {
                lastMessageClass += " fw-semibold text-dark"; // bold if unread
            } else {
                lastMessageClass += " text-muted"; // normal if seen
            }

            // 📨 Last message text logic
            let lastMessageText = "Start a conversation";
            if (user.last_message && user.last_message.trim() !== "") {
                lastMessageText = user.last_message;
            } else if (user.attachments && user.attachments.length > 0) {
                lastMessageText = (user.attachments.length > 1) ? "Attachments" : "Attachment";
            }

            userListHtml += `
            <li id="contact-id-${user.emp_id}" class="chat-user-item" data-name="direct-message">
                <a href="javascript:void(0);" onclick="openChat('${user.emp_id}', '${user.name}', '${user.photo}')">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 chat-user-img mt-1">
                            <img src="http://172.16.161.34:8080/hrms/${user.photo}" 
                                class="img-thumbnail avatar-xs rounded-circle" 
                                style="border-color: orange"> 
                        </div>
                        <div class="flex-grow-1 ms-2" style="min-width:0;">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="fw-semibold fs-10">${user.name}</span>
                                <span class="text-muted fs-10">${formatTime(user.date_send)}</span>
                                ${unreadBadge}
                            </div>
                            
                            <p class="${lastMessageClass} mb-0 fs-10 last-message"
                            style="display: -webkit-box; 
                                    -webkit-line-clamp: 2; 
                                    -webkit-box-orient: vertical; 
                                    overflow: hidden; 
                                    text-overflow: ellipsis; 
                                    white-space: normal;">
                                ${escapeHtml(lastMessageText)}
                            </p>
                        </div>
                    </div>
                </a>
            </li>`;

        });
        $("#userList").html(userListHtml);
    }


    function displayContacts(users) {

        let contactListHtml = "";
        users.forEach(user => {
            let lastMsg = user.last_message && user.last_message.trim() !== ""
                ? user.last_message
                : "Start a conversation";
            let unreadBadge = "";
            if (user.unseen_count > 0) {
                unreadBadge = `<span class="unseen-badge badge bg-danger rounded-pill ms-1" style="font-size: 8px;">${user.unseen_count}</span>`;
            }

                        // ✅ Active chat highlighting
            let activeChat = $("#receiver_id").val();
            let lastMessageClass = "";
            if (user.unseen_count > 0 && activeChat != user.emp_id && user.sender_id != currentUsers) {
                lastMessageClass += " fw-semibold text-dark"; // bold if unread
            } else {
                lastMessageClass += " text-muted"; // normal if seen
            }

            // 📨 Last message text logic
            let lastMessageText = "Start a conversation";
            if (user.last_message && user.last_message.trim() !== "") {
                lastMessageText = user.last_message;
            } else if (user.attachments && user.attachments.length > 0) {
                lastMessageText = (user.attachments.length > 1) ? "Attachments" : "Attachment";
            }

            contactListHtml += `
                <li id="contact-tab-id-${user.emp_id}" class="contact-user-item">
                    <a href="javascript:void(0);" onclick="openChat('${user.emp_id}', '${user.name}', '${user.photo}')">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 chat-user-img mt-1">
                                <img src="http://172.16.161.34:8080/hrms/${user.photo}" class="img-thumbnail avatar-xs rounded-circle" style="border-color: #fd9d0dff">
                            </div>
                            <div class="flex-grow-1 ms-2" style="min-width:0;">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="fw-semibold fs-10">${user.name}</span>
                                    <span class="text-muted fs-10">${formatTime(user.date_send)}</span>
                                    ${unreadBadge}
                                </div>
                                <p class="${lastMessageClass} mb-0 fs-10" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis; white-space: normal;">
                                    ${lastMsg}
                                </p>
                            </div>
                        </div>
                    </a>
                </li>`;

        });

        $(".sort-contact").html(`<ul class="list-unstyled">${contactListHtml}</ul>`);
    }

    function openChat(receiver_id, userName, photo) {
        $("#receiver_id").val(receiver_id);
        $(".user-chat-topbar .username").text(userName);
        $("#profile_photo").attr("src", `http://172.16.161.34:8080/hrms/${photo}`).show();
        $("#defaultChatMessage").hide();
        $(".chat-user-item").removeClass("active-user");
        $(`#contact-id-${receiver_id}`).addClass("active-user");

        $("#users-conversation").html(`
            <div id="elmLoader">
                <div class="spinner-border text-primary avatar-sm" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        `);

        $.ajax({
            url: '<?php echo base_url('get_messages'); ?>',
            method: 'POST',
            data: {
                user_id: currentUsers,
                receiver_id: receiver_id
            },
            success: function (response) {
                let messages = JSON.parse(response) || [];
                $("#users-conversation").html("");
                messages.forEach(msg => {
                    renderMessage({
                        id: msg.id,
                        sender_id: msg.sender_id,
                        receiver_id: msg.receiver_id,
                        message: msg.message,
                        attachments: msg.attachments || [],
                        time: formatTime(msg.date_send),
                        photo: msg.photo,
                        reaction: msg.reaction,
                        reply_to: msg.reply_to,
                        replied_message: msg.replied_message,
                        reply_user: msg.reply_user,
                        receiver_name: msg.receiver_name
                    }, currentUsers);
                });

                if (messages.length > 0) {
                    let lastMsg = messages[messages.length - 1];
                    addToChatList(
                        receiver_id,
                        userName,
                        lastMsg.photo,
                        lastMsg.message,
                        lastMsg.date_send,
                        lastMsg.attachments || [],
                        lastMsg.sender_id
                    );
                }

                $.post('<?php echo base_url('chat/mark_seen'); ?>', {
                    sender_id: receiver_id,
                    receiver_id: currentUsers
                }, function (resp) {
                    clearUnreadForUser(receiver_id);
                }).fail(function () {
                    clearUnreadForUser(receiver_id);
                });

                setTimeout(scrollToBottom, 200);
            }
        });
    }

    function renderMessage(data, currentUsersDataId) {
        let alignment = (data.sender_id == currentUsersDataId) ? "right" : "left";
        let isMine = alignment === "right";

        let bubbleColor = isMine ? "bg-info text-white" : "bg-light";
        let bubbleClass = "p-2 px-3 rounded-4 shadow-sm";

        let attachments = [];
        if (data.attachments && data.attachments.length > 0) {
            data.attachments.forEach(item => {
                try {
                    let parsed = JSON.parse(item);
                    attachments.push(...(Array.isArray(parsed) ? parsed : [parsed]));
                } catch (e) {
                    attachments.push(item);
                }
            });
        }

        const reactionBtn = (msgId, reaction, messageOwnerId) => {
            if (!isMine) {
                return `
                    <div class="reaction-wrapper mt-1">
                        <button class="btn btn-sm btn-light rounded-circle btn-reaction fs-10" 
                            id="react-btn-${msgId}"
                            data-message-id="${msgId}" 
                            data-current-reaction="${reaction || ""}" 
                            title="React">
                            ${reaction ? reaction : `<i class="ri-emotion-line"></i>`}
                        </button>
                    </div>`;
            }
            if (reaction) {
                return `<div class="reaction-wrapper">
                            <span class="reaction-display" id="reaction-${msgId}">${reaction}</span>
                        </div>`;
            }
            return `<div class="reaction-wrapper mt-1">
                        <span class="reaction-display" id="reaction-${msgId}"></span>
                    </div>`;
        };

        let attachmentHTML = attachments.map(file => {
            let ext = (file + '').split('.').pop().toLowerCase();
            let fileUrl = `${baseUrl}assets/uploads/chat_files/${file}`;
            let wrapperClass = isMine
                ? "chat-attachment mb-1 bg-info text-white p-2 rounded-3 shadow-sm d-inline-block"
                : "chat-attachment mb-1 bg-light text-dark p-2 rounded-3 shadow-sm d-inline-block";

            if (['jpg', 'jpeg', 'png', 'gif', 'webp'].includes(ext)) {
                return `<div class="${wrapperClass}">
                            <a href="${fileUrl}" target="_blank">
                                <img src="${fileUrl}" class="rounded-3 img-fluid shadow-sm" style="max-width:180px;">
                            </a>
                        </div>`;
            } else if (['mp4', 'webm', 'ogg', 'mov', 'avi'].includes(ext)) {
                return `<div class="${wrapperClass}">
                            <video controls preload="metadata" style="max-width:240px;" class="rounded-3 shadow-sm">
                                <source src="${fileUrl}" type="video/${ext}">
                            </video>
                            <div><a href="${fileUrl}" target="_blank" class="text-decoration-none ${isMine ? "text-white" : "text-dark"}">${file}</a></div>
                        </div>`;
            } else if (ext === 'pdf') {
                return `<div class="${wrapperClass}">
                            <iframe src="${fileUrl}#toolbar=0" 
                                style="width:100%;max-width:300px;height:200px;border:1px solid #ddd;border-radius:6px;" 
                                loading="lazy"></iframe>
                            <div><a href="${fileUrl}" target="_blank" class="text-decoration-none ${isMine ? "text-white" : "text-dark"}"><i class="ri-file-pdf-line"></i> ${file}</a></div>
                        </div>`;
            } else if (['txt', 'log', 'md'].includes(ext)) {
                return `<div class="${wrapperClass}">
                            <a href="${fileUrl}" target="_blank" class="text-decoration-none ${isMine ? "text-white" : "text-dark"}"><i class="ri-file-text-line"></i> ${file}</a>
                        </div>`;
            } else if (['doc', 'docx'].includes(ext)) {
                return `<div class="${wrapperClass}">
                            <a href="${fileUrl}" target="_blank" class="text-decoration-none ${isMine ? "text-white" : "text-dark"}"><i class="ri-file-word-line"></i> ${file}</a>
                        </div>`;
            } else if (['xls', 'xlsx', 'csv'].includes(ext)) {
                return `<div class="${wrapperClass}">
                            <a href="${fileUrl}" target="_blank" class="text-decoration-none ${isMine ? "text-white" : "text-dark"}"><i class="ri-file-excel-line"></i> ${file}</a>
                        </div>`;
            } else {
                return `<div class="${wrapperClass}">
                            <a href="${fileUrl}" target="_blank" class="text-decoration-none ${isMine ? "text-white" : "text-dark"}"><i class="ri-attachment-2"></i> ${file}</a>
                        </div>`;
            }
        }).join("");

        let msgContent = escapeHtml(data.message || "");
        if (isEmojiOnly(data.message)) {
            msgContent = `<span class="big-emoji">${msgContent}</span>`;
        }
        let replyHTML = "";
        if (data.reply_to && (data.replied_message || data.replied_attachments)) {
            replyHTML = `
        <div class="reply-block p-2 mb-1 rounded-3 small ${isMine ? "bg-primary-subtle text-dark" : "bg-secondary-subtle text-dark"}">
            <div class="fw-bold mb-1">
                ${data.replied_user_name || (isMine ? "You" : data.receiver_name + ' <span class="text-muted">replied to your message..</span>')}
            </div>
            <div class="text-truncate">
                ${data.replied_message
                    ? escapeHtml(data.replied_message)
                    : (data.replied_attachments ? "[Attachment]" : "")
                }
            </div>
        </div>`;
        }

        let msgBubble = (msgContent || attachments.length > 0 || replyHTML) ? `
            <div class="${bubbleColor} ${bubbleClass}">
                ${replyHTML}
                ${msgContent ? `<div class="${isMine ? "text-white" : "text-dark"}">${msgContent}</div>` : ""}
                ${attachmentHTML}
            </div>
        ` : "";

        $("#users-conversation").append(`
            <li class="chat-list ${alignment}">
                <div class="d-flex ${isMine ? "justify-content-end" : "justify-content-start"}">
                    ${!isMine ? `
                    <div class="chat-avatar me-2">
                        <img src="http://172.16.161.34:8080/hrms/${data.photo || ''}" 
                            class="rounded-circle shadow-sm" width="36" height="36" alt="user">
                    </div>` : ""}

                    <div class="chat-bubble-container ${isMine ? "text-end" : "text-start"}">
                        ${msgBubble}
                        <div class="d-flex align-items-center mt-1 ${isMine ? "justify-content-end" : "justify-content-start"} gap-2">
                            ${reactionBtn(data.id, data.reaction, data.sender_id)}
                            <button class="btn btn-sm btn-light rounded-circle btn-reply fs-12" 
                                data-message-id="${data.id}" 
                                data-message-text="${escapeHtml(data.message || "")}" 
                                title="Reply">
                                <i class="ri-reply-line"></i>
                            </button>
                        </div>
                        <div class="chat-time text-muted small mt-1 mb-1 ${isMine ? "text-end" : "text-start"}" style="font-size:.5rem">
                            ${data.time}
                        </div>
                    </div>

                    ${isMine ? `
                    <div class="chat-avatar ms-2">
                        <img src="http://172.16.161.34:8080/hrms/${data.photo || ''}" 
                            class="rounded-circle shadow-sm" width="36" height="36" alt="me">
                    </div>` : ""}
                </div>
            </li>
        `);

        $(".btn-reply").off("click").on("click", function () {
            let msgId = $(this).data("message-id");
            let replyText = $(this).data("message-text");
            let userName = $(this).closest(".chat-list").hasClass("right") ? "You" : $(".user-chat-topbar .username").text();

            $(".replyCard").addClass("show");
            $(".replyCard .replymessage-block .flex-grow-1 .mb-0").text(replyText);
            $(".replyCard .replymessage-block .flex-grow-1 .conversation-name").text(userName);
            $("#reply_to_message_id").val(msgId);

            $("#close_toggle").off("click").on("click", function () {
                $(".replyCard").removeClass("show");
            });
        });

        $(".btn-reaction").off("click").on("click", function () {
            let msgId = $(this).data("message-id");
            let currentReaction = $(this).data("current-reaction");
            let emojis = ["👍", "❤️", "😂", "😮", "😢", "😡"];
            if (currentReaction) emojis.push("❌");

            let emojiHTML = emojis.map(e => `
                <button class="emoji-circle select-reaction btn btn-light rounded-circle m-1" 
                    data-emoji="${e}" 
                    data-message-id="${msgId}">
                    ${e}
                </button>
            `).join("");

            Swal.fire({
                html: `<div class="emoji-bar d-flex flex-wrap justify-content-center">${emojiHTML}</div>`,
                showConfirmButton: false,
                width: "auto",
                padding: "0",
                background: "transparent",
            });

            $(document).off("click", ".select-reaction").on("click", ".select-reaction", function () {
                let selectedEmoji = $(this).data("emoji");
                let btn = $(`#react-btn-${msgId}`);

                if (selectedEmoji === "❌") {
                    btn.html(`<i class="ri-emotion-line"></i>`);
                    btn.data("current-reaction", "");
                } else {
                    btn.html(selectedEmoji);
                    btn.data("current-reaction", selectedEmoji);
                }
                Swal.close();

                $.ajax({
                    url: "<?php echo base_url('Chat/save_reaction'); ?>",
                    type: "POST",
                    data: {
                        message_id: msgId,
                        user_id: currentUsers,
                        reaction: (selectedEmoji === "❌" ? "" : selectedEmoji)
                    },
                    success: function (res) {
                        let response = JSON.parse(res);
                        if (response.status === "success") {
                            socket1.emit("sendReaction", {
                                message_id: msgId,
                                sender_id: currentUsers,
                                receiver_id: $("#receiver_id").val(),
                                reaction: response.reaction,
                                reaction_user_id: response.reaction_user_id
                            });
                            toastr.success("Reaction updated!");
                        } else {
                            toastr.error("Failed to save reaction.");
                        }
                    }
                });
            });
        });

        setTimeout(scrollToBottom, 200);
    }

    socket1.on("newReaction", function (data) {
        if (data.sender_id == currentUsers || data.receiver_id == currentUsers) {
            if (data.reaction === null || data.reaction === "") {
                $(`#reaction-${data.message_id}`).text("");
            } else {
                $(`#reaction-${data.message_id}`).text(data.reaction);
            }
        }
    });

    socket1.on("typing", function (data) {
        if (data.receiver_id == currentUsers && data.sender_id == $("#receiver_id").val()) {
            $("#typing-indicator")
                .html(`
                    <div class="mb-5">
                        <iconify-icon icon="svg-spinners:3-dots-scale" width="24" height="24"></iconify-icon>
                    </div>
                `)
                .fadeIn();
        }
    });

    // When other user stops typing
    socket1.on("stopTyping", function (data) {
        if (data.receiver_id == currentUsers && data.sender_id == $("#receiver_id").val()) {
            $("#typing-indicator").fadeOut();
        }
    });

    function timeAgo(dateString) {
        const now = new Date();
        const messageDate = new Date(dateString);
        const diffMs = now - messageDate;

        const seconds = Math.floor(diffMs / 1000);
        const minutes = Math.floor(seconds / 60);
        const hours = Math.floor(minutes / 60);
        const days = Math.floor(hours / 24);

        if (days > 0) {
            return days === 1 ? "1 day ago" : `${days} days ago`;
        } else if (hours > 0) {
            return hours === 1 ? "1 hour ago" : `${hours} hours ago`;
        } else if (minutes > 0) {
            return minutes === 1 ? "1 min ago" : `${minutes} mins ago`;
        } else {
            return "Just Now";
        }
    }


    function isEmojiOnly(text) {
        return /^[\p{Emoji}\p{Extended_Pictographic}\s]+$/u.test(text);
    }

    function addToChatList(receiver_id, userName, photo, last_message, last_time, attachments = [], sender_id = null) {
        let chatItem = $(`#contact-id-${receiver_id}`);

        let activeChat = $("#receiver_id").val();

        let displayMessage = "Start a conversation";

        if (last_message && last_message.trim() !== "") {
            displayMessage = last_message;
        } else if (attachments.length > 0) {
            displayMessage = (attachments.length > 1) ? "Attachments" : "Attachment";
        }

        let lastMessageClass = "last-message mb-0";
        if (activeChat == receiver_id) {
            lastMessageClass += " text-muted";
        } else {
            lastMessageClass += (sender_id != currentUsers) ? " fw-bold" : " text-muted";
        }

        if (chatItem.length) {
            chatItem.find(".last-message").attr("class", lastMessageClass).html("&nbsp;&nbsp;" + escapeHtml(displayMessage));
            chatItem.find(".last-time").text(formatTime(last_time));
        } else {
            $("#userList").append(`
                <li id="contact-id-${receiver_id}" class="chat-user-item" data-name="direct-message" data-contact-id="${receiver_id}">
                    <a href="javascript:void(0);" onclick="openChat('${receiver_id}', '${userName}', '${photo}')">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 chat-user-img mt-1">
                                <img src="http://172.16.161.34:8080/hrms/${photo}" class="img-thumbnail avatar-xs rounded-circle" style="border-color: orange"> 
                            </div>
                            <div class="flex-grow-1">
                                <p class="mb-0 fs-10 fw-semibold">&nbsp;&nbsp; ${userName}</p>
                                <p class="${lastMessageClass} text-truncate" style="display: -webkit-box; 
                                    -webkit-line-clamp: 2; 
                                    -webkit-box-orient: vertical; 
                                    overflow: hidden; 
                                    text-overflow: ellipsis; 
                                    white-space: normal;">&nbsp;&nbsp; ${escapeHtml(displayMessage)}</p>
                            </div>
                            <div class="text-end text-muted mt-2" style="min-width:48px">
                                <small class="last-time" style="font-size: .5rem">${formatTime(last_time)}</small>
                            </div>
                        </div>
                    </a>
                </li>
            `);
        }
    }

    function clearUnreadForUser(userId) {
        let userIndex = allUsers.findIndex(u => u.emp_id == userId);
        if (userIndex !== -1) {
            allUsers[userIndex].seen = 'Yes';
            allUsers[userIndex].unseen_count = 0;
        }
        $(`#contact-id-${userId} .unseen-badge`).remove();
        $(`#contact-id-${userId} .last-message`).removeClass('fw-bold').addClass('text-muted');
        updateUnseenCount();
        message_unseen();
    }
    function escapeHtml(unsafe) {
        if (unsafe === null || unsafe === undefined) return '';
        return String(unsafe)
            .replace(/&/g, "&amp;")
            .replace(/</g, "&lt;")
            .replace(/>/g, "&gt;")
            .replace(/"/g, "&quot;")
            .replace(/'/g, "&#039;");
    }
    function formatTime(dateString) {
        if (!dateString) return '';

        let date;
        if (typeof dateString === "string") {
            const isoString = dateString.replace(" ", "T");
            date = new Date(isoString);
        } else if (dateString instanceof Date) {
            date = dateString;
        } else if (typeof dateString === "number") {
            date = new Date(dateString);
        } else {
            return '';
        }

        if (isNaN(date.getTime())) return '';

        const now = new Date();
        const diffMs = now - date;
        const diffSec = Math.floor(diffMs / 1000);
        const diffMin = Math.floor(diffSec / 60);
        const diffHour = Math.floor(diffMin / 60);
        const diffDay = Math.floor(diffHour / 24);

        if (diffDay > 0) {
            return diffDay === 1 ? "1 day ago" : diffDay + " days ago";
        } else if (diffHour > 0) {
            return diffHour === 1 ? "1 hour ago" : diffHour + " hours ago"; 
        } else if (diffMin > 0) {
            return diffMin === 1 ? "1 minute ago" : diffMin + " mins ago";
        } else {
            return "Just now";
        }
    }

    function scrollToBottom() {
        let chatContainer = document.querySelector("#chat-conversation");
        if (chatContainer) {
            let simpleBarInstance = SimpleBar.instances.get(chatContainer);
            if (simpleBarInstance) {
                let scrollElement = simpleBarInstance.getScrollElement();
                scrollElement.scrollTop = scrollElement.scrollHeight;
            } else {
                chatContainer.scrollTop = chatContainer.scrollHeight;
            }
        }
    }
    function searchMessages() {
        var input = document.getElementById("searchMessage").value.toUpperCase();
        var conversationList = document.getElementById("users-conversation");
        var items = conversationList.getElementsByTagName("li");

        var found = false;

        Array.from(items).forEach(function (li) {
            var textEl = li.getElementsByTagName("div")[0];
            var text = textEl ? (textEl.textContent || textEl.innerText) : "";

            if (text.toUpperCase().indexOf(input) > -1) {
                li.style.display = "";
                found = true;
            } else {
                li.style.display = "none";
            }
        });

        // Remove any existing "no results" message+
        var noResultMsg = document.getElementById("noResultsMsg");
        if (noResultMsg) {
            noResultMsg.remove();
        }

        if (!found && input.trim() !== "") {
            var li = document.createElement("li");
            li.id = "noResultsMsg";
            li.className = "text-center text-muted py-1";
            li.innerHTML = '<i class="ri-search-eye-line"></i> No messages available for your search';
            conversationList.appendChild(li);
        }
    }
</script>

<style>
    .chat-conversation-list {
        padding: 15px;
        background: #f0f2f5;
        overflow-y: auto;
    }

    .chat-user-item {
        padding: 10px;
        transition: background 0.3s;
    }

    .chat-user-item:hover {
        background: rgba(0, 123, 255, 0.1);
        cursor: pointer;
    }

    .chat-user-item.active-user {
        background: rgba(0, 123, 255, 0.2);
        font-weight: bold;
    }

    .emoji-picker__wrapper {
        z-index: 999999999;
    }

    .chat-user-item.highlighted {
        background-color: #ffe9b3;
        /* light yellow highlight */
        transition: background-color 1s ease;
    }

    .unread-message {
        /* bold */
        color: #000 !important;
        /* darker text */
    }
</style>