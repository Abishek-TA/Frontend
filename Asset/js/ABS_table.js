function increaseQuantity(itemId) {
    const quantityElement = document.getElementById(
        `quantity_${itemId}`
    );
    let quantity = parseInt(quantityElement.textContent);
    quantity++;
    quantityElement.textContent = quantity;
}

function decreaseQuantity(itemId) {
    const quantityElement = document.getElementById(
        `quantity_${itemId}`
    );
    let quantity = parseInt(quantityElement.textContent);
    if (quantity > 0) {
        quantity--;
        quantityElement.textContent = quantity;
    }
}

function redirectToOrderSummary() {
    // Construct URL parameters based on selected item quantities
    let urlParams = new URLSearchParams();
    document.querySelectorAll(".menuItem").forEach((item) => {
        const itemId = item.id;
        const quantity = parseInt(
            document.getElementById(`quantity_${itemId}`)
                .textContent
        );
        if (quantity > 0) {
            urlParams.append(itemId, quantity);
        }
    });

    // Redirect to order summary page with URL parameters
    window.location.href = `order_summary.html?${urlParams.toString()}`;
}
