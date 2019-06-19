function deleteRecord(type, recordID) {
    if (confirm("Are you sure?")) {
        $.ajax({
            url: base_url + '/common/delete',
            method: 'GET',
            async: false,
            data: {recordID: recordID, type: type},
            success: function (response) {
                $(".message").html(response);
                $("#row_" + recordID).remove();
            }
        });
    }
}
