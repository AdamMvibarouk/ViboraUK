document.addEventListener("DOMContentLoaded", () => {
  loadBasket();
  setupCheckoutForm();
});

async function loadBasket() {
  const itemsBody = document.getElementById("basket-items");
  const totalEl = document.getElementById("basket-total");

  try {
    const res = await fetch("/api/cart", {
      credentials: "include",
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
      const price = Number(item.price) || 0;
      const quantity = Number(item.quantity) || 0;
      const lineTotal = price * quantity;

      grandTotal += lineTotal;

      const tr = document.createElement("tr");
      tr.innerHTML = `
        <td><h2>${item.name}</h2></td>

        <td>
          <div class="qty-control" data-id="${item.cart_item_id}">
            <button type="button" class="qty-minus">-</button>
            <span class="qty-number">${quantity}</span>
            <button type="button" class="qty-plus">+</button>
          </div>
        </td>

        <td><h2>£${lineTotal.toFixed(2)}</h2></td>

        <td>
          <button type="button" class="remove-btn" data-id="${item.cart_item_id}">
            Remove
          </button>
        </td>
      `;
      itemsBody.appendChild(tr);
    });

    totalEl.textContent = `£${grandTotal.toFixed(2)}`;
    enableRemoval();
    enableQuantityButtons();
  } catch (err) {
    console.error("Error loading basket:", err);
    itemsBody.innerHTML = `<tr><td colspan="4">Error loading basket.</td></tr>`;
    totalEl.textContent = "£00.00";
  }
}

function enableRemoval() {
  document.querySelectorAll(".remove-btn").forEach((btn) => {
    btn.addEventListener("click", async () => {
      const id = btn.getAttribute("data-id");

      try {
        await fetch(`/api/cart/remove/${id}`, {
          method: "DELETE",
          credentials: "include",
        });

        loadBasket();
      } catch (err) {
        console.error("Error removing item:", err);
      }
    });
  });
}

function enableQuantityButtons() {
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
          await fetch(`/api/cart/remove/${id}`, {
            method: "DELETE",
            credentials: "include",
          });
        } else {
          await fetch(`/api/cart/update/${id}`, {
            method: "PATCH",
            headers: {
              "Content-Type": "application/json",
            },
            credentials: "include",
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
        await fetch(`/api/cart/update/${id}`, {
          method: "PATCH",
          headers: {
            "Content-Type": "application/json",
          },
          credentials: "include",
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

    const nameOnCard = form.elements["nameOnCard"].value.trim();
    const numberOnCard = form.elements["numberOnCard"].value.trim();
    const expiry = form.elements["expiry"].value.trim();
    const cvv = form.elements["cvv"].value.trim();

    if (!nameOnCard || !numberOnCard || !expiry || !cvv) {
      alert("Please fill in all card details.");
      return;
    }

    try {
      const res = await fetch("/api/cart/checkout", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        credentials: "include",
      });

      const data = await res.json();

      if (!res.ok) {
        alert(data.message || "There was a problem completing your order.");
        return;
      }

      alert("Thank you! Your order has been placed.");
      form.reset();
      loadBasket();
    } catch (err) {
      console.error("Checkout error:", err);
      alert("Unexpected error completing your order.");
    }
  });
}