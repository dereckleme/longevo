$(document).ready(function(){
    $(".detalheChamado").click(function () {
        var url = $(this).attr("href");

        $.ajax({
            url: url,
            type: "get",
            success: function(data) {
                $(".ModalTitulo").html('#' + data.id + " " + data.titulo);
                $(".ModalDescricao").html('Descrição do chamado: </br><br/>' + data.descricao);
                $(".modal").modal(true);
            },
            error: function(){

            },
        });
        return false;
    })

    $(".adicionarChamado").click(function () {
        var url = $(this).attr("href");

        $.ajax({
            url: url,
            type: "get",
            success: function(data) {
                $(".ModalTitulo").html('Adicionar Chamado');
                $(".ModalDescricao").html(data);
                $(".modal").modal(true);
            },
            error: function(){

            },
        });
        return false;
    })

    $(".ModalDescricao").on("click", ".submitNovoChamado", function () {
        var str = $( ".ModalDescricao form" ).serialize();
        var url = $(".adicionarChamado").attr("href");

        $.ajax({
            url: url,
            type: "post",
            data: str,
            success: function(data) {
                if (data.action) {
                    $(".modal").modal('toggle')
                    alert("Chamado adicionado com sucesso!");
                    location.reload();
                } else {
                    $(".ModalTitulo").html('Adicionar Chamado');
                    $(".ModalDescricao").html(data);
                    $(".modal").modal(true);
                }
            },
            error: function(){

            },
        });

        return false;
    })
});