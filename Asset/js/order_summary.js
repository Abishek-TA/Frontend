document.addEventListener("DOMContentLoaded", function() {
    const urlParams = new URLSearchParams(window.location.search);
    const orderItems = document.getElementById("orderItems");
    let totalAmount = 0;

    urlParams.forEach((quantity, itemId) => {
        const itemAmount = quantity * getItemPrice(itemId);
        const itemBox = document.createElement("div");
        itemBox.classList.add("itemBox");
        const itemImg = document.createElement("img");
        itemImg.src = `./Asset/Images/${itemId}.png`;
        itemImg.alt = `${itemId}`;
        itemBox.appendChild(itemImg);
        const itemName = document.createElement("p");
        itemName.textContent = `${formatItemName(itemId)} - Quantity: ${quantity}`;
        itemBox.appendChild(itemName);
        const itemTotal = document.createElement("p");
        itemTotal.textContent = `Total: ₹${itemAmount}`;
        itemBox.appendChild(itemTotal);

        orderItems.appendChild(itemBox);
        totalAmount += itemAmount;
    });

    const totalBox = document.createElement("div");
    totalBox.classList.add("totalBox");
    totalBox.textContent = `Total Amount: ₹${totalAmount}`;/*totalamount*/
    orderItems.appendChild(totalBox);
});
function formatItemName(itemId) {
    return itemId.replace(/_/g, ' ');
}

function getItemPrice(itemId) {
    switch (itemId) {
        case "veg_burger":
            return 143;
        case "veg_pizza":
            return 143; 
        case "chicken_pizza":
            return 143; 
        case "chili_pizza":
            return 143; 
        case "veg_sandwich":
            return 143; 
        case "mushroom_pizza":
            return 143;
        case "shawarma":
            return 143;
        case "vegroll":
            return 143;
        case "chocolate_icecream":
            return 143;
        case "crab_lollipop":
            return 143;
        case "french_fries":
            return 143;
        case "chicken_lollipop":
           return 143;
        case "chettinad_chicken_gravy":
           return 143;
        case "panner_butter_masala":
            return 143;
        case "mojito":
            return 143;
        case "falooda":
            return 143; 
        default:
            return 143; 
    }
}