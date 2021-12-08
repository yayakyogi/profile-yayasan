window.addEventListener("DOMContentLoaded", (event) => {
  // Toggle the side navigation
  const sidebarToggle = document.body.querySelector("#sidebarToggle");
  if (sidebarToggle) {
    // Uncomment Below to persist sidebar toggle between refreshes
    if (localStorage.getItem("sb|sidebar-toggle") === "true") {
      document.body.classList.toggle("sb-sidenav-toggled");
    }
    sidebarToggle.addEventListener("click", (event) => {
      event.preventDefault();
      document.body.classList.toggle("sb-sidenav-toggled");
      localStorage.setItem(
        "sb|sidebar-toggle",
        document.body.classList.contains("sb-sidenav-toggled")
      );
    });
  }
});

function messageError() {
  console.log("OK");
  //   Swal.fire({
  //     icon: "error",
  //     title: title,
  //     text: message,
  //   });
}

const messageSuccess = ({ $title, $message }) => {
  Swal.fire({
    icon: "success",
    title: $title,
    text: $message,
  });
};
