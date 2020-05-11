//const firebase=require("firebase");
// Firebase Config
const config = {
  
};

firebase.initializeApp(config);

var nameForm =document.getElementById("nameForm");
var nameInput = document.getElementById("name-input");
var nameBtn = document.getElementById("name-btn");
var messageScreen = document.getElementById("messages");
var messageForm = document.getElementById("messageForm");
var msgInput = document.getElementById("msg-input");
var msgBtn = document.getElementById("msg-btn");
//const db = firebase.database();
//const msgRef = db.ref("/msgs");
var messagesRef = firebase.database().ref('chatmessages');
var id = uuid();
let name;

messageForm.addEventListener("submit", event => {
  event.preventDefault();

  var text = msgInput.value;

  if (!name) {
    return alert("You have to set up some name");
  } else if (!text.trim()) return alert("You have to type in some msg");

  var msg = {
    id,
    name,
    text
  };

  messagesRef.push(msg);
  msgInput.value = "";
});

var updateMsges = data => {
  var { id: userID, name, text } = data.val();
  var msg = `<li class="msg ${id == userID && "my"}"><span>
      <i class="name">${name}: </i> ${text}
        </span>
              </li>`;
  messageScreen.innerHTML += msg;
};

messagesRef.on("child_added", updateMsges);

nameForm.addEventListener("submit", e => {
  e.preventDefault();
  if (nameInput.value.trim().length < 4)
    return alert("Name should be more than 4 characters");

  nameForm.style.display = "none";
  msgInput.removeAttribute("disabled");
  msgBtn.removeAttribute("disabled");
  return (name = nameInput.value);
});

