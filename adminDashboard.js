document.addEventListener("DOMContentLoaded", () => {
  const buttons = document.querySelectorAll("[data-panel-target]");
  const panels = document.querySelectorAll(".panel-section");


  buttons.forEach((btn) => {
    btn.addEventListener("click", () => {
      const targetId = btn.dataset.panelTarget;
      panels.forEach((panel) => {
        panel.classList.toggle("active", panel.id === targetId);
      });


      const targetPanel = document.getElementById(targetId);
      if (targetPanel) {
        targetPanel.scrollIntoView({ behavior: "smooth", block: "start" });
      }
    });
  });


  
  const ordersEl = document.getElementById("stat-orders");
  const revenueEl = document.getElementById("stat-revenue");
  const usersEl = document.getElementById("stat-users");


  if (ordersEl && revenueEl && usersEl) {
    const totalOrders = 142;
    const totalRevenue = 18670.35;
    const activeUsers = 87;


    ordersEl.textContent = totalOrders;
    revenueEl.textContent = totalRevenue.toFixed(2);
    usersEl.textContent = activeUsers;
  }
});





