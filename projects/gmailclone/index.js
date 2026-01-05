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
