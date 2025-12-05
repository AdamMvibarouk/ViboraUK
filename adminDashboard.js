document.addEventListener("DOMContentLoaded", function () {
    var cards = document.querySelectorAll("#admin-cards .product-card");

    var panels = {
        products: document.getElementById("panel-products"),
        orders: document.getElementById("panel-orders"),
        messages: document.getElementById("panel-messages"),
        stats: document.getElementById("panel-stats")
    };

    function hideAllPanels() {
        Object.keys(panels).forEach(function (key) {
            if (panels[key]) {
                panels[key].style.display = "none";
            }
        });
    }

    function showPanel(name) {
        hideAllPanels();
        if (panels[name]) {
            panels[name].style.display = "block";
        }
    }

    cards.forEach(function (card) {
        var panelName = card.getAttribute("data-panel");
        var button = card.querySelector("button");
        if (panelName && button) {
            button.addEventListener("click", function () {
                showPanel(panelName);
            });
        }
    });

    var lowStock = [
        "Vibora Venom Pro – 3 left",
        "Bullpadel Hack Control – 4 left",
        "Vibora King Cobra – 5 left"
    ];

    var orders = [
        "Order #1042 – £249.99 – Paid",
        "Order #1041 – £89.50 – Dispatched",
        "Order #1040 – £129.00 – Pending"
    ];

    var messages = [
        "alice@gmail.com – Delivery question",
        "coach@padelclub.com – Team order enquiry",
        "info@padelacademy.uk – Bulk rackets quote"
    ];

    var stats = [
        "Total registered customers: 241",
        "Total products in store: 63",
        "Orders placed this month: 112",
        "Average order value: £94.20"
    ];

    function fillList(listId, items) {
        var ul = document.getElementById(listId);
        if (!ul) return;
        ul.innerHTML = "";
        items.forEach(function (text) {
            var li = document.createElement("li");
            li.textContent = text;
            ul.appendChild(li);
        });
    }

    fillList("lowStockList", lowStock);
    fillList("ordersList", orders);
    fillList("messagesList", messages);
    fillList("statsList", stats);

    var msgSearch = document.getElementById("msgSearch");
    if (msgSearch) {
        msgSearch.addEventListener("input", function () {
            var term = msgSearch.value.toLowerCase();
            var items = document.querySelectorAll("#messagesList li");
            items.forEach(function (li) {
                var match = li.textContent.toLowerCase().includes(term);
                li.style.display = match ? "list-item" : "none";
            });
        });
    }

    showPanel("products");
});
