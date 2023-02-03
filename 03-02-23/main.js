const deleteInJs =  (id) => {
    $.ajax({
        url: `page2.php?id=${id}`,
        type: "POST",
        beforesend: () => {
            $("#villages").html("Message before")
        },
        success: messageToShow => {
            
            $("#users").html(messageToShow)
        }
    })
}