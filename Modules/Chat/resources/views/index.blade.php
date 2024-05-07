@extends('chat::layouts.master')

@push('styles')
    <style type="text/css">
        #users > li {
            cursor: pointer;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">Chat</div>

                    <div class="card-body">
                        <div class="row p-2">
                            <div class="col-10">
                                <div class="row">
                                    <div class="col-12 border rounded-lg p-3" id="chat-box">
                                        <ul
                                            id="messages"
                                            class="list-unstyled overflow-auto"
                                            style="height: 45vh"
                                        >
                                        </ul>
                                    </div>
                                </div>
                                <form>
                                    <div class="row py-3">
                                        <div class="col-8">
                                            <input id="message" class="form-control" type="text">
                                        </div>
                                        <div class="col-2">
                                            <button id="send" type="submit" class="btn btn-primary btn-block">Send
                                            </button>
                                        </div>
                                        <div class="col-2">
                                            <button id="clear-notifications" type="submit"
                                                    class="btn btn-danger btn-block">
                                                clear notifications
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-2">
                                <p><strong>Online Now</strong></p>
                                <ul
                                    id="users"
                                    class="list-unstyled overflow-auto text-info"
                                    style="height: 45vh"
                                >
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('modules/chat/js/pusher.js') }}"></script>
    <script>
        showOnlineUsers();
        sendMessage();

        Echo1.join('user-has-joined')
            .here((users) => {
                showOnlineUsers(users)
            })
            .joining((user) => {
                const chatBox = document.querySelector("#messages");
                let newDiv = document.createElement("li");
                newDiv.classList.add("alert", "alert-success", 'join-notification');
                newDiv.innerHTML = user.name + " has joined the chat";
                chatBox.appendChild(newDiv);
                let audio = new Audio('{{ asset("modules/chat/sounds/join.mp3") }}');
                audio.play();
                addJoinedUserToList(user);
            })
            .leaving((user) => {
                const chatBox = document.querySelector("#messages");
                let newDiv = document.createElement("li");
                newDiv.classList.add("alert", "alert-danger", "join-notification");
                newDiv.innerHTML = user.name + " has left the chat";
                chatBox.appendChild(newDiv);
                let audio = new Audio('{{ asset("modules/chat/sounds/left.mp3") }}');
                audio.play();
                const listItems = document.querySelector("#users");

                for (let i = 0; i < listItems.children.length; i++) {
                    const anchorTag = listItems.children[i].querySelector('a');
                    if (anchorTag && anchorTag.href.includes(user.email) && anchorTag.textContent.trim() === user.name) {
                        listItems.children[i].remove();
                    }
                }
            });


        /*
                Echo1.channel('send-message')
                    .listen('.Modules\\Chat\\App\\Events\\SendMessageEvent', (e) => {
                        const chatBox = document.querySelector("#messages");
                        let newDiv = document.createElement("li");
                        newDiv.innerHTML = `
                                <span class="font-weight-bold" style="color:red; display: inline">${e.message.user}: </span>
                                <p class="font-weight-bold" style="display: inline"">${e.message.message}</p>
                            `;
                        chatBox.appendChild(newDiv);
                        let audio = new Audio('https://proxy.notificationsounds.com/message-tones/to-the-point-568/download/file-sounds-1111-to-the-point.mp3');
                        audio.play();
                    });
        */

        Echo1.channel('send-message')
            .listen('.Modules\\Chat\\App\\Events\\SendMessageEvent', (e) => {
                console.log(e);
                const chatBox = document.querySelector("#messages");
                let newDiv = document.createElement("li");
                newDiv.innerHTML = `
                        <span class="font-weight-bold" style="color:red; display: inline">${e.message.user}: </span>
                        <p class="font-weight-bold" style="display: inline"">${e.message.message}</p>
                    `;
                chatBox.appendChild(newDiv);
                let audio = new Audio('{{ asset("modules/chat/sounds/left.mp3") }}');
                audio.play();
            });

        function showOnlineUsers(users) {
            const list = document.querySelector("#users");
            list.innerHTML = '';

            for (let user in users) {
                const ListOfOnlineUsers = document.createElement("li");
                const newUserJoined = document.createElement("a");

                let route = "{{ route('private-chat-view', ['user'=>':user']) }}";
                route = route.replace(':user', users[user].email);

                newUserJoined.setAttribute("href", route);
                newUserJoined.innerText = users[user].name;

                ListOfOnlineUsers.appendChild(newUserJoined);
                list.append(ListOfOnlineUsers);
            }
        }

        function sendMessage() {
            const send = document.querySelector('#send');
            send.addEventListener('click', function (e) {
                e.preventDefault();
                const messageElement = document.getElementById('message');
                let currentUser = @json(auth()->user());
                window.axios.post(`{{ route('send') }}`, {
                    message: messageElement.value,
                    user: currentUser.name
                });
                messageElement.value = '';
            });
        }

        function addJoinedUserToList(user) {
            const listItems = document.querySelector("#users");

            for (let i = 0; i < listItems.children.length; i++) {
                const anchorTag = listItems.children[i].querySelector('a');
                if (anchorTag && !anchorTag.href.includes(user.email) && anchorTag.textContent.trim() !== user.name) {
                    const ListOfOnlineUsers = document.createElement("li");
                    const newUserJoined = document.createElement("a");

                    let route = "{{ route('private-chat-view', ['user'=>':user']) }}";
                    route = route.replace(':user', user.email);

                    newUserJoined.setAttribute("href", route);
                    newUserJoined.innerText = user.name;

                    ListOfOnlineUsers.appendChild(newUserJoined);
                    listItems.append(ListOfOnlineUsers);
                }
            }
        }

        function clearJoinedNotifications() {
            const clearNotifications = document.querySelector("#clear-notifications");
            clearNotifications.addEventListener("click", function (e) {
                e.preventDefault();
                document.querySelectorAll('.join-notification').forEach((element) => {
                    element.remove();
                })
            });
        }

    </script>
@endpush
