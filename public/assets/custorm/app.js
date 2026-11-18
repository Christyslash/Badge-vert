$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });

    $('.btn-delete').click(function () {
        let ressource = $(this).data('ressource');
        $('#idRessource').val(ressource.id);
    })

    $('.btn-delete1').click(function () {
        let ressource = $(this).data('ressource1');
        $('#idRessource').val(ressource.pivot.user_id);
        $('#idRessource1').val(ressource.pivot.groupe_id);
    })

     $('.btn-delete').click(function () {
        let ressource = $(this).data('ressource');
        $('#voyage_id').val(ressource.voyage_id);
        $('#depense_id').val(ressource.depense_id);
        $('#code_budgetaire_id').val(ressource.code_budgetaire_id);
    })

    $('#ac-planning,#sortir-confimer').modal({
        backdrop: 'static',
        keyboard: false
    })

    $('#nouvStock').keyup(function () {
        let qte = $('#qteStock').val();
        notifier(qte)
    })
    $("#formAfficher").submit(function (){
        $("#load").removeAttr('hidden');
        $("#afficher").attr('hidden','hidden')
    })

});
