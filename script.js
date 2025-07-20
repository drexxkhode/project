function showAlert(message, duration = 2000) {
  const modal = document.getElementById("alertModal");
  const messageEl = document.getElementById("alertMessage");

  messageEl.innerText = message;
  modal.style.display = "block";

  // Automatically hide after duration
  setTimeout(() => {
    modal.style.display = "none";
  }, duration);
}
