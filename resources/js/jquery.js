import $ from 'jquery';

$(document).ready(function() {
    $("#addExam").submit(function(e) {
        e.preventDefault();
        console.log("Submitted");
        var formData = $(this).serialize();

        $.ajax({
            url: "{{ route('addExam') }}",
            type: "POST",
            data: formData,
            success: function(data) {
                if (data.success == true) {
                    location.reload();
                } else {
                    alert(data.msg);
                }
            }
        });
    });
});

$("#addAnswer").click(function() {
    var html = `
        <div class="row mt-2 answers">
            <input type="radio" name="is_correct" class="is_correct">
            <div class="col">
                <input type="text" class="w-100" name="answers[]" placeholder="Enter Answer" required>
            </div>
            <button class="btn btn-danger">Remove</button>    
        </div>
    `;
    $(".model-body").append(html);
});