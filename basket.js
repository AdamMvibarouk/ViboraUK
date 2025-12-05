document.addEventListener("DOMContentLoaded", () => {
  loadBasket();
  setupCheckoutForm();
});

async function loadBasket() {
  const itemsBody = document.getElementById("basket-items");
  const totalEl = document.getElementById("basket-total");
  const token = localStorage.getItem("token");

  if (!token) {
    alert("Please log in first.");
    window.location.href = "accountPage.html";
    return;
  }

  try {
    const res = await fetch("http://localhost:5000/api/cart", {
      headers: { Authorization: "Bearer " + token },
    });

    const data = await res.json();

    if (!res.ok) {
      itemsBody.innerHTML = `<tr><td colspan="4">Error loading basket.</td></tr>`;
      totalEl.textContent = "£00.00";
      return;
    }

    const items = data.items || [];
    itemsBody.innerHTML = "";
    let grandTotal = 0;

    if (!items.length) {
      itemsBody.innerHTML = `<tr><td colspan="4"><h3>Your basket is empty.</h3></td></tr>`;
      totalEl.textContent = "£00.00";
      return;
    }

    items.forEach((item) => {
      const lineTotal = Number(item.line_total) || 0;
      grandTotal += lineTotal;

      const tr = document.createElement("tr");
      tr.innerHTML = `
        <td><h2>${item.name}</h2></td>

        <td>
          <div class="qty-control" data-id="${item.cart_item_id}">
            <button class="qty-minus">-</button>
            <span class="qty-number">${item.quantity}</span>
            <button class="qty-plus">+</button>
          </div>
        </td>

        <td><h2>£${lineTotal.toFixed(2)}</h2></td>

        <td>
          <button class="remove-btn" data-id="${item.cart_item_id}">
            Remove
          </button>
        </td>
      `;
      itemsBody.appendChild(tr);
    });

    totalEl.textContent = `£${grandTotal.toFixed(2)}`;
    enableRemoval(token);
    enableQuantityButtons(token);
  } catch (err) {
    console.error("Error loading basket:", err);
  }
}

function enableRemoval(token) {
  document.querySelectorAll(".remove-btn").forEach((btn) => {
    btn.addEventListener("click", async () => {
      const id = btn.getAttribute("data-id");

      try {
        await fetch(`http://localhost:5000/api/cart/remove/${id}`, {
          method: "DELETE",
          headers: { Authorization: "Bearer " + token },
        });
        loadBasket();
      } catch (err) {
        console.error("Error removing item:", err);
      }
    });
  });
}

function enableQuantityButtons(token) {
  document.querySelectorAll(".qty-control").forEach((box) => {
    const id = box.getAttribute("data-id");
    const minusBtn = box.querySelector(".qty-minus");
    const plusBtn = box.querySelector(".qty-plus");
    const numSpan = box.querySelector(".qty-number");

    minusBtn.addEventListener("click", async () => {
      let current = Number(numSpan.textContent) || 1;
      const newQty = current - 1;

      try {
        if (newQty < 1) {
          await fetch(`http://localhost:5000/api/cart/remove/${id}`, {
            method: "DELETE",
            headers: { Authorization: "Bearer " + token },
          });
        } else {
          await fetch(`http://localhost:5000/api/cart/update/${id}`, {
            method: "PATCH",
            headers: {
              "Content-Type": "application/json",
              Authorization: "Bearer " + token,
            },
            body: JSON.stringify({ quantity: newQty }),
          });
        }
        loadBasket();
      } catch (err) {
        console.error("Error updating quantity:", err);
      }
    });

    plusBtn.addEventListener("click", async () => {
      let current = Number(numSpan.textContent) || 1;
      const newQty = current + 1;

      try {
        await fetch(`http://localhost:5000/api/cart/update/${id}`, {
          method: "PATCH",
          headers: {
            "Content-Type": "application/json",
            Authorization: "Bearer " + token,
          },
          body: JSON.stringify({ quantity: newQty }),
        });
        loadBasket();
      } catch (err) {
        console.error("Error updating quantity:", err);
      }
    });
  });
}

function setupCheckoutForm() {
  const form = document.getElementById("basket-form");
  if (!form) return;

  form.addEventListener("submit", async (e) => {
    e.preventDefault();

    const token = localStorage.getItem("token");
    if (!token) {
      alert("Please log in before checking out.");
      window.location.href = "accountPage.html";
      return;
    }

    const nameOnCard = form.elements["nameOnCard"].value.trim();
    const numberOnCard = form.elements["numberOnCard"].value.trim();
    const expiry = form.elements["expiry"].value.trim();
    const cvv = form.elements["cvv"].value.trim();

    if (!nameOnCard || !numberOnCard || !expiry || !cvv) {
      alert("Please fill in all card details.");
      return;
    }

    try {
      const res = await fetch("http://localhost:5000/api/orders/checkout", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          Authorization: "Bearer " + token,
        },
        body: JSON.stringify({
          payment_method: "card",
          card_last4: numberOnCard.slice(-4),
        }),
      });

      const data = await res.json();

      if (!res.ok) {
        alert(data.error || "There was a problem completing your order.");
        return;
      }

      alert("Thank you! Your order is being processed.");
      form.reset();
      loadBasket();
    } catch (err) {
      console.error("Checkout error:", err);
      alert("Unexpected error completing your order.");
    }
  });
}