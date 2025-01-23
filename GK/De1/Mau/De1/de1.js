const games = [
    {
        name: "EA SPORTS FC 24",
        nsx: "Electronic Arts",
        price: 1500000,
    },
    {
        name: "Marvel's Spider-Man 2",
        nsx: "Sony Entertainment",
        price: 1600000,
    },
    {
        name: "Sonic Superstars",
        nsx: "Sega",
        price: 1400000,
    },
    {
        name: "Hogwarts Legacy",
        nsx: "WB Games",
        price: 1350000,
    },
    {
        name: "Minecraft Legends",
        nsx: "Microsoft",
        price: 1200000,
    },
    {
        name: "Dragon Quest Treasures",
        nsx: "Square Enix",
        price: 1150000,
    },
    {
        name: "Moving Out 2",
        nsx: "Team17 Digital Ltd.",
        price: 850000,
    },
    {
        name: "No Man's Sky",
        nsx: "Hello Games",
        price: 1100000,
    },
];

const createGame = (game) => {
    const gameItem = document.createElement("li");
    gameItem.innerHTML = `<img
                    src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQGIWjp5Ds1kmlcz9qh3KK4UnsaDJ-tF7_bhA&s"
                    alt="EA SPORTS FC 24"
                />
                <p class="title">${game.name}</p>
                <p class="producer">${game.nsx}</p>
                <span>Giá: <span class="price">${game.price}</span></span>
                <form action="">
                    <label for="quantity">Số lượng</label>
                    <input type="number" value="1" id="quantity" />
                    <label for="buy">Chọn mua</label>
                    <input type="checkbox" />
                </form>`;
    gameItem.classList.add("game-item");
    return gameItem;
};

const renderGames = () => {
    const gameContainer = document.getElementById("game_container");
    games.forEach((game) => {
        gameContainer.appendChild(createGame(game));
    });
};

renderGames();

const buttonSubmit = document.getElementById("button_submit");

const submitHandle = () => {
    let selectedItems = [];
    const gameItems = document.querySelectorAll(".game-item");
    const customerName = document.querySelector("#customerName").value;
    const customerContact = document.querySelector("#customerContact").value;
    console.log(customerName + " " + customerContact);

    gameItems.forEach((item) => {
        const checkbox = item.querySelector('input[type="checkbox"]');

        if (checkbox.checked) {
            const gameName = item.querySelector(".title").textContent;
            const gamePrice = +item.querySelector(".price").textContent;
            const gameQuantity = +item.querySelector("#quantity").value;
            const gameSelected = {
                name: gameName,
                price: gamePrice,
                quantity: gameQuantity,
            };
            selectedItems = [...selectedItems, gameSelected];
            console.log(selectedItems);
        }
    });

    const paymentWindow = window.open("", "_blank");

    let total = 0; // Initialize total to 0

    const invoiceRows = selectedItems
        .map((item) => {
            const price = item.quantity * item.price;
            total += price; // Accumulate the price for the total

            return `<tr>
                <td>${item.name}</td>
                <td>${item.quantity}</td>
                <td>${item.price}</td>
                <td>${price}</td>
            </tr>`;
        })
        .join("");
    paymentWindow.document.write(`<div class="invoice-container">
            <div class="invoice-header">
                <h2>Hóa đơn</h2>
            </div>
            <table class="customer-info-table">
                <tr>
                    <td><strong>Họ tên khách hàng:</strong></td>
                    <td>${customerName}</td>
                </tr>
                <tr>
                    <td><strong>Địa chỉ liên hệ/Số điện thoại:</strong></td>
                    <td>${customerContact}</td>
                </tr>
            </table>

            <table class="game-table">
                <thead>
                    <tr>
                        <th>Đĩa game</th>
                        <th>SL</th>
                        <th>Đơn giá</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                ${invoiceRows}
                </tbody>
            </table>

            <p class="total-price"><strong>Tổng tiền: ${total} đ</strong></p>
        </div>`);
};
buttonSubmit.addEventListener("click", submitHandle);
