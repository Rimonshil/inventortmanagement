class Notification {

    success() {
        new Noty({
            type:'success',
            layout: 'topRight',
            text: 'Successfully Done',
            timeout:1000

        }).show();
    }


    alert() {
        new Noty({
            type:'alert',
            layout: 'topRight',
            text: 'Are you Sure?',
            timeout:1000

        }).show();
    }

    warning() {
        new Noty({
            type:'warning',
            layout: 'topRight',
            text: 'oops error!!',
            timeout:1000

        }).show();
    }

    image_validation() {
        new Noty({
            type:'warning',
            layout: 'topRight',
            text: 'Upload image less than 1 mb',
            timeout:1000

        }).show();
    }

}

export default Notification = new Notification()