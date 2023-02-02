const saludar = async () => {
    $.ajax({
        url: "page2.php",
        type: "POST",
        beforesend: () => {
            $("#idMessage").html("Message before")
        },
        success: messageToShow => {
            $("#idMessage").html(messageToShow)
        }
    })
}