const saludar = async () => {
    const params = {
        "name": "Aitor",
        "surname": "Santana",
        "phone": "123456789",
    }

    // $.ajax({
    //     data: params,
    //     url: "page2.php",
    //     type: "POST",
    //     beforesend: () => {
    //         $("#idMessage").html("Message before")
    //     },
    //     success: messageToShow => {
    //         $("#idMessage").html(messageToShow)
    //     }
    // })

    const response = await fetch("page2.php", {
        method: "POST",
        headers: {
            "Content-type": "application/json"
        },
        body: JSON.stringify(params),
    }).then(data => console.log(data))
    const data = await response.json()

    // console.log(data)

    // const message = document.querySelector("#idMessage");
    // message.innerHTML = JSON.stringify(data)
}