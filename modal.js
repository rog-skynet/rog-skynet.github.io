function openModal() {
  document.getElementById("gitHandleModal").style.display = "block";
}

function closeModal() {
  document.getElementById("gitHandleModal").style.display = "none";
}

// Close modal if user clicks outside of it
window.onclick = function(event) {
  const modal = document.getElementById("gitHandleModal");
  if (event.target == modal) {
    modal.style.display = "none";
  }
};
