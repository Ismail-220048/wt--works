    function openTab(event, tabId) {
      for (let content of document.querySelectorAll('.tab-content')) {
        content.classList.remove('active');
        content.style.opacity = 0;
        content.style.transform = "translateY(10px)";
      }
      for (let menu of document.querySelectorAll('.sidebar .menu div')) {
        menu.classList.remove('active');
      }
      for (let tab of document.querySelectorAll('.tabs .tab')) {
        tab.classList.remove('active');
      }
      
      const targetContent = document.getElementById(tabId);
      if(targetContent) {
          targetContent.classList.add('active');
          setTimeout(() => {
              targetContent.style.opacity = 1;
              targetContent.style.transform = "translateY(0)";
          }, 50);
      }
      
      event.currentTarget.classList.add('active');
      
      // If triggered from sidebar, it might not be a top tab, but primary is default
      if (tabId === 'primary' || tabId === 'social' || tabId === 'promotions') {
         document.querySelector('.sidebar .menu div[onclick*="primary"]').classList.add('active');
      } else {
         let sidebarMatch = document.querySelector(`.sidebar .menu div[onclick*="${tabId}"]`);
         if(sidebarMatch) sidebarMatch.classList.add('active');
      }
    }

    function openMail(mailElement) {
      var sender = mailElement.querySelector(".sender").innerText;
      var subject = mailElement.querySelector(".subject").innerText;
      var time = mailElement.querySelector(".time").innerText;
      var body = mailElement.querySelector(".mail-body").innerHTML;
      var attachment = mailElement.querySelector(".mail-attachment").innerHTML;

      document.getElementById("popupSender").innerHTML = "<strong>From:</strong> " + sender;
      document.getElementById("popupSubject").innerText = subject;
      document.getElementById("popupTime").innerText = time;
      document.getElementById("popupBody").innerHTML = body;
      
      if(attachment.trim() !== "") {
          document.getElementById("popupAttachment").innerHTML = "<strong>Attachment:</strong> " + attachment;
          document.getElementById("popupAttachment").style.display = 'block';
      } else {
          document.getElementById("popupAttachment").style.display = 'none';
      }

      const popup = document.getElementById("popup");
      popup.style.display = "flex";
      setTimeout(() => popup.classList.add("show"), 10);
    }

    function cls() {
      const popup = document.getElementById("popup");
      popup.classList.remove("show");
      setTimeout(() => popup.style.display = "none", 300);
    }

    const fileInput = document.getElementById('composeFile');
    const fileNameDisplay = document.getElementById('fileName');

    fileInput.addEventListener('change', () => {
        if(fileInput.files.length > 0){
            fileNameDisplay.innerHTML = `<i class="fa-solid fa-paperclip"></i> ` + fileInput.files[0].name;
        } else {
            fileNameDisplay.textContent = "";
        }
    });

    function closeCompose() {
        const popup = document.getElementById('composePopup');
        popup.classList.remove("show");
        setTimeout(() => popup.style.display = 'none', 300);
    }

    document.querySelector('.compose').addEventListener('click', () => {
        const popup = document.getElementById('composePopup');
        popup.style.display = 'flex';
        setTimeout(() => popup.classList.add("show"), 10);
    });

    // Close popups when clicking outside
    window.addEventListener('click', function(e) {
        let popupInside = document.querySelector('#popup .inner-card');
        if (e.target === document.getElementById('popup')) {
             cls();
        }
    });

    // ---------------- Toast Notifications & Polling ----------------
    
    // Create Toast Container
    const toastContainer = document.createElement('div');
    toastContainer.id = 'toast-container';
    document.body.appendChild(toastContainer);

    function showToast(message, type = 'success') {
        const toast = document.createElement('div');
        toast.className = `toast ${type}`;
        
        let iconClass = 'fa-circle-check';
        if(type === 'error') iconClass = 'fa-circle-exclamation';
        if(type === 'info') iconClass = 'fa-envelope-open-text';
        
        toast.innerHTML = `<i class="fa-solid ${iconClass} icon fa-lg"></i> <span>${message}</span>`;
        toastContainer.appendChild(toast);
        
        setTimeout(() => {
            if(toast.parentElement) toast.remove();
        }, 5000);
    }

    // Check URL parameters
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('success')) {
        showToast(urlParams.get('success'), 'success');
        window.history.replaceState({}, document.title, window.location.pathname);
    } else if (urlParams.has('error')) {
        showToast(urlParams.get('error'), 'error');
        window.history.replaceState({}, document.title, window.location.pathname);
    }

    // Polling for new messages
    let lastCheck = Math.floor(Date.now() / 1000);
    setInterval(async () => {
        try {
            const res = await fetch(`check_new_mails.php?last_check=${lastCheck}`);
            const data = await res.json();
            
            if (data.count > 0 && data.senders) {
                lastCheck = data.last_check;
                
                // Show notification for each new message
                data.senders.forEach(sender => {
                    showToast(`New message received from <b>${sender}</b>`, 'info');
                });
                
                // We should Ideally update DOM, but for now we suggest a reload or the user just sees the notification
                // They can refresh to see it in the list.
            }
        } catch(e) {
            console.error(e);
        }
    }, 10000);

