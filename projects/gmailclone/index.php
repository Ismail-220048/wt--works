<?php
include "config.php";

if (!isset($_SESSION['email'])) {
    header("Location: index.html");
    exit();
}

$userEmail = $_SESSION['email'];
$userName = $_SESSION['user'];

// Fetch inbox (where to == userEmail)
$inboxMailsCursor = $mailsCollection->find(['to' => $userEmail], ['sort' => ['created_at' => -1]]);
$inboxMails = iterator_to_array($inboxMailsCursor);

// Fetch sent mails (where sender_email == userEmail)
$sentMailsCursor = $mailsCollection->find(['sender_email' => $userEmail], ['sort' => ['created_at' => -1]]);
$sentMails = iterator_to_array($sentMailsCursor);

function renderMail($mail, $isSent = false) {
    $senderName = isset($mail['sender_name']) ? $mail['sender_name'] : 'Unknown';
    $senderEmail = isset($mail['sender_email']) ? $mail['sender_email'] : '';
    $to = isset($mail['to']) ? $mail['to'] : '';
    $subject = $mail['subject'] ? htmlspecialchars($mail['subject']) : '(No Subject)';
    $message = $mail['message'] ? nl2br(htmlspecialchars($mail['message'])) : '';
    $date = $mail['created_at'] ? $mail['created_at']->toDateTime()->format('M d, Y') : '';
    $filePath = isset($mail['file_path']) ? $mail['file_path'] : '';
    $fileName = isset($mail['file_name']) ? $mail['file_name'] : '';

    $displayName = $isSent ? "To: " . $to : $senderName;

    echo "<div class='email' onclick='openMail(this)'>
            <div class='sender'>$displayName</div>
            <div class='subject'>$subject <span style='margin-left:5px'>- " . substr(strip_tags($message), 0, 50) . "...</span></div>
            <div class='time'>$date</div>
            <div class='mail-body' style='display:none'>$message</div>
            <div class='mail-attachment' style='display:none'>";
    if($filePath) {
        echo "<i class='fa-solid fa-paperclip'></i> <a href='$filePath' download='$fileName'>$fileName</a>";
    }
    echo "</div></div>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>IS-mail | Inbox</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="index.css" />
</head>

<body>
  
  <div class="topbar">
    <div class="logo2">
      <img src="logo.png" alt="Logo">
    </div>
    <div class="logo">IS-mail</div>
    <input type="text" class="search" placeholder="Search mail" />
    <a href="logout.php" class="auth-btn"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
    <div class="profile" title="<?php echo htmlspecialchars($userName); ?>">
      <?php echo strtoupper(substr($userName, 0, 1)); ?>
    </div>
  </div>

  <div class="container">
    
    <div class="sidebar">
      <div class="compose"><i class="fa-solid fa-pen"></i> Compose</div>
      <div class="menu">
        <div class="active" onclick="openTab(event,'primary')"><i class="fa-solid fa-inbox"></i> Inbox</div>
        <div onclick="openTab(event,'Sent')"><i class="fa-solid fa-paper-plane"></i> Sent</div>
        <div onclick="openTab(event,'Drafts')"><i class="fa-solid fa-file"></i> Drafts</div>
        <div onclick="openTab(event,'Spam')"><i class="fa-solid fa-circle-exclamation"></i> Spam</div>
      </div>
    </div>

    <div class="email-list">
      <div class="tabs">
        <div class="tab active" onclick="openTab(event,'primary')">Primary</div>
      </div>

      <div class="tab-contents-wrapper">
        <div id="primary" class="tab-content active">
          <?php 
          if(count($inboxMails) > 0) {
              foreach($inboxMails as $mail) renderMail($mail);
          } else {
              echo "<div class='empty-state'><i class='fa-solid fa-inbox fa-3x' style='margin-bottom:15px;color:#cbd5e1'></i><br>Your inbox is empty</div>";
          }
          ?>
        </div>

        <div id="Sent" class="tab-content">
          <?php 
          if(count($sentMails) > 0) {
              foreach($sentMails as $mail) renderMail($mail, true);
          } else {
              echo "<div class='empty-state'><i class='fa-solid fa-paper-plane fa-3x' style='margin-bottom:15px;color:#cbd5e1'></i><br>No sent messages</div>";
          }
          ?>
        </div>

        <div id="Drafts" class="tab-content">
           <div class='empty-state'><i class='fa-solid fa-file fa-3x' style='margin-bottom:15px;color:#cbd5e1'></i><br>No drafts found</div>
        </div>

        <div id="Spam" class="tab-content">
           <div class='empty-state'><i class='fa-solid fa-circle-exclamation fa-3x' style='margin-bottom:15px;color:#cbd5e1'></i><br>Hooray, no spam here!</div>
        </div>
      </div>
    </div>
  </div>

  <div id="popup">
    <div class="inner-card">
      <div class="popup-header">
        <div class="popup-header-info">
          <h3 id="popupSubject">Subject</h3>
          <p id="popupSender">From: sender</p>
          <p id="popupTime">Time</p>
        </div>
        <button class="popup-close" onclick="cls()"><i class="fa-solid fa-xmark"></i></button>
      </div>
      <div class="popup-body">
        <div id="popupBody">Body</div>
        <div id="popupAttachment" class="popup-attachment" style="display:none"></div>
      </div>
    </div>
  </div>
  
  <div id="composePopup" class="compose-popup">
    <div class="compose-header">
      <span>New Message</span>
      <span class="close-btn" onclick="closeCompose()"><i class="fa-solid fa-xmark"></i></span>
    </div>
    <form action="send_mail.php" method="post" enctype="multipart/form-data">
      <div class="compose-body">
        <input type="email" placeholder="To (Email Address)" name="to" required>
        <input type="text" placeholder="Subject" name="subject" required>
        <textarea placeholder="Write your message here..." name="message" required></textarea>
        
        <div class="file-upload-wrapper">
          <label for="composeFile" class="file-label"><i class="fa-solid fa-paperclip"></i> Upload Attachment</label>
          <input type="file" id="composeFile" name="file" style="display:none">
          <span id="fileName"></span> 
        </div>
      </div>

      <div class="compose-footer">
        <input type="submit" name="upload" value="Send Message">
      </div>
    </form>
  </div>

  <script src="index.js"></script>

</body>
</html>
