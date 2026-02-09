
    function openTab(event, tabId) {
      for (let content of document.querySelectorAll('.tab-content')) {
        content.classList.remove('active');
      }
      for (let menu of document.querySelectorAll('.menu div')) {
        menu.classList.remove('active');
      }
      for (let tab of document.querySelectorAll('.tabs .tab')) {
        tab.classList.remove('active');
      }
      document.getElementById(tabId).classList.add('active');
      event.target.classList.add('active');
    }

    function openMail(mail) {
      var sender = mail.querySelector(".sender").innerText;
      var subject = mail.querySelector(".subject").innerText;
      var time = mail.querySelector(".time").innerText;

      document.getElementById("popupSender").innerText = sender;
      document.getElementById("popupSubject").innerText = subject;
      document.getElementById("popupTime").innerText = time;

      document.getElementById("popup").style.display = "block";
    }

    
    function cls() {
      document.getElementById("popup").style.display = "none";
    }const fileInput = document.getElementById('composeFile');
const fileNameDisplay = document.getElementById('fileName');

// Show file name when selected
fileInput.addEventListener('change', () => {
    if(fileInput.files.length > 0){
        fileNameDisplay.textContent = "Attached: " + fileInput.files[0].name;
    } else {
        fileNameDisplay.textContent = "";
    }
});

// Optional: Send mail function demo
function sendMail() {
    const to = document.getElementById('composeTo').value;
    const subject = document.getElementById('composeSubject').value;
    const message = document.getElementById('composeMessage').value;
    const file = fileInput.files[0];

    if(to && subject && message){
        let fileInfo = file ? `\nAttached file: ${file.name}` : "";
        alert(`Mail sent to: ${to}\nSubject: ${subject}\nMessage: ${message}${fileInfo}`);

        closeCompose();

        // Clear fields
        document.getElementById('composeTo').value = '';
        document.getElementById('composeSubject').value = '';
        document.getElementById('composeMessage').value = '';
        fileInput.value = '';
        fileNameDisplay.textContent = '';
    } else {
        alert("Please fill all fields!");
    }
}

// Close compose popup
function closeCompose() {
    document.getElementById('composePopup').style.display = 'none';
}

// Open compose popup
document.querySelector('.compose').addEventListener('click', () => {
    document.getElementById('composePopup').style.display = 'flex';
});
