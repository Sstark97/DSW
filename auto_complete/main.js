const searchVillages =  () => {
    const village = $("#search").val()
    const params = {
        "municipio": village
    }

    $.ajax({
        data: params,
        url: `autoCompletaMunicipios.php?modo=ul`,
        type: "POST",
        beforesend: () => {
            $("#villages").html("Message before")
        },
        success: messageToShow => {
            $("#villages").html(messageToShow)
        }
    })
}