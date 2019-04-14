$(document).ready(function () {
    $("#add_blog").validate({
        rules: {
            title: {
                required: true,
                maxlength: 200
            },
            editor1: {
                required: true
            },
            is_comment_available: {
                required: true
            }
        },
        messages: {
            title: {
                required: "Please enter email.",
                maxlength: "Maximum 200 characters are allowed."
            },
            editor1: {
                required: "Please enter description."
            },
            is_comment_available: {
                required: "Please select valid comment visible option."
            }
        }
    });
    $("#add_product").validate({
        rules: {
            title: {
                required: true,
                maxlength: 200
            },
            editor1: {
                required: true
            },
            ingredients: {
                required: true
            }
        },
        messages: {
            title: {
                required: "Please enter email.",
                maxlength: "Maximum 200 characters are allowed."
            },
            editor1: {
                required: "Please enter description."
            },
            ingredients: {
                required: "Please enter ingredients."
            }
        }
    });
    $("#add_comment").validate({
        rules: {
            blog_id: {
                required: true,
            },
            comment: {
                required: true
            }
        },
        messages: {
            blog_id: {
                required: "Please select blog."
            },
            comment: {
                required: "Please enter comment."
            }
        }
    });
    $("#change_password").validate({
        rules: {
            old_password: {
                required: true,
            },
            new_password: {
                required: true
            },
            re_type_password: {
                required: true,
                equalTo: "#new_password"
            }
        },
        messages: {
            old_password: {
                required: "Please enter old password."
            },
            new_password: {
                required: "Please enter new password."
            },
            re_type_password: {
                required: "Please enter re-type new password.",
                equalTo: "Please enter same as new password."
            }
        }
    });
});