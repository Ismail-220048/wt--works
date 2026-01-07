
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
    }