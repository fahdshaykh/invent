class Notification {
    success()
    {
        new Noty({
            type: 'success',
            layout: 'bottomCenter',
            text: 'Data Created successfully',
            timeout: 3000,
        }).show();
    }

    alert()
    {
        new Noty({
            type: 'alert',
            layout: 'bottomCenter',
            text: 'Are you sure?',
            timeout: 3000,
        }).show();
    }

    error()
    {
        new Noty({
            type: 'alert',
            layout: 'bottomCenter',
            text: 'Something went wrong',
            timeout: 3000,
        }).show();
    }

    warning()
    {
        new Noty({
            type: 'warning',
            layout: 'bottomCenter',
            text: 'Oops try again!',
            timeout: 3000,
        }).show();
    }

    image_validation()
    {
        new Noty({
            type: 'error',
            layout: 'bottomCenter',
            text: 'image size should not be creater then 1MB',
            timeout: 3000,
        }).show();
    }

    cart_success()
    {
        new Noty({
            type: 'success',
            layout: 'bottomCenter',
            text: 'Successfully Added',
            timeout: 3000,
        }).show();
    }

}

export default Notification = new Notification();
