const API_BASE = "http://localhost:5000";

document.addEventListener("DOMContentLoaded", () => {
    const table = document.getElementById("table");
    if (!table) return;

    const token = localStorage.getItem("token"); 
    if (!token) {
        addMessageRow(table, "Please log in to view your order history.");
        return;
    }

    loadOrderHistory(table, token);
});

async function loadOrderHistory(table, token) {
    try {
        const res = await fetch(`${API_BASE}/api/orders`, {
            method: "GET",
            headers: {
                "Authorization": `Bearer ${token}`
            }
        });

        const data = await res.json();

        if (!res.ok) {
            addMessageRow(table, data.error || "Error loading order history.");
            return;
        }

        const orders = data.orders || [];

        if (!orders.length) {
            addMessageRow(table, "You have no past orders.");
            return;
        }

        clearTableRowsExceptHeader(table);

        orders.forEach(order => {
            const row = table.insertRow(-1);
            const descCell = row.insertCell(0);
            const sizeCell = row.insertCell(1);
            const priceCell = row.insertCell(2);

            descCell.innerHTML =
                `<strong>Order #${order.order_number}</strong><br>
                <span>${order.items.length} item(s)</span>`;

            sizeCell.textContent = "-";
            priceCell.textContent = `£${Number(order.grand_total).toFixed(2)}`;

            order.items.forEach(item => {
                const itemRow = table.insertRow(-1);
                const itemDesc = itemRow.insertCell(0);
                const itemSize = itemRow.insertCell(1);
                const itemPrice = itemRow.insertCell(2);

                itemDesc.textContent = `• Product: ${item.product_id}`;
                itemSize.textContent = `Qty: ${item.quantity}`;
                itemPrice.textContent = `£${Number(item.line_total).toFixed(2)}`;
            });

            const spacer = table.insertRow(-1);
            const spacerCell = spacer.insertCell(0);
            spacerCell.colSpan = 3;
            spacerCell.style.padding = "10px 0";
        });

    } catch (err) {
        console.error("Error loading order history:", err);
        addMessageRow(table, "Server error while loading data.");
    }
}

function clearTableRowsExceptHeader(table) {
    while (table.rows.length > 1) {
        table.deleteRow(1);
    }
}

function addMessageRow(table, message) {
    clearTableRowsExceptHeader(table);
    const row = table.insertRow(-1);
    const cell = row.insertCell(0);
    cell.colSpan = 3;
    cell.textContent = message;
}
