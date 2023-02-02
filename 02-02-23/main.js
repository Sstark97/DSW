const villages = async () => {
    const id = $( "#islands" ).val();
    $( "#villages" ).prop('disabled', false);

    $.ajax({
        url: `page2.php?id=${id}`,
        type: "POST",
        beforesend: () => {
            $("#villages").html("Message before")
        },
        success: messageToShow => {
            console.log(messageToShow)
            $("#villages").html(messageToShow)
        }
    })
}