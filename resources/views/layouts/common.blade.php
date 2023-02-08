<style>
    p{
        font-size: 12px;
    }
    .commonListBody table th, .commonListBody table td{
        padding: 2px 10px!important;
    }
    .btn-xs{
        padding: 0.125rem 0.25rem;
        font-size: 0.700rem;
        line-height: 1.5;
        border-radius: 0.2rem;
    }
    .icon-xs{
        font-size: 1rem!important;
    }
    .page-content{
        padding: 5px;
    }
    .shortcut_toggle{
        display: none;
    }
    .insert_drawer_full_page{
        background-color: rgba(0, 0, 0, .4);
        transition: 0.5s ease;
        min-width: 100%;
        position: fixed;
        right: -100%;
        top: 53px;
        z-index:90000
    }
    .insert_drawer{
        min-width: 400px;
        max-width: 400px;
        position:relative;
        float: right;
        min-height: calc(100vh - 53px);
        overflow-y: auto;
        overflow-x: hidden;
        background-color: rgb(206, 221, 234);
    }
    .insert_drawer_full_page.open {
        right: 0 !important;
    }
    .swal2-container{
        z-index: 999999;
    }
    #loaded_info {
        position: relative;
        width: 100%;
        z-index: 1;
        margin: auto;
        overflow: auto;
        max-height: 580px;
    }

    #loaded_info table {
        width: 100%;
        min-width: 992px;
        margin: auto;
        border-collapse: collapse;
    }

    #loaded_info th,
    #loaded_info td {
        padding: 5px 10px;
        border: 1px solid #000;
        background: #fff;
        vertical-align: top;
        font-size: 12px;
    }

    #loaded_info thead th {
        background: #333;
        color: #fff;
        position: -webkit-sticky;
        position: sticky;
        top: 0;
        white-space: nowrap
    }

    /* safari and ios need the tfoot itself to be position:sticky also */
    #loaded_info tfoot,
    #loaded_info tfoot th,
    #loaded_info tfoot td {
        position: -webkit-sticky;
        position: sticky;
        bottom: 0;
        background: #666;
        color: #fff;
        z-index: 2;
    }

    /* #loaded_info th:nth-child(1),
        #loaded_info td:nth-child(1) {
            position: -webkit-sticky;
            position: sticky;
            left: 0;
            z-index: 2;
            background: #777;
            border: 1px solid #000;
        }
        #loaded_info th:nth-child(2),
        #loaded_info td:nth-child(2) {
            position: -webkit-sticky;
            position: sticky;
            left: 34px;
            z-index: 2;
            background: #777;
            border: 1px solid #000;
        } */
    thead th:first-child,
    tfoot th:first-child {
        z-index: 5;
    }
    .select2-container{
        z-index: 900001;
    }
</style>
<script>
    $(".form_submit").submit(function(e) {
        e.preventDefault();
        var customConfig = {
            enctype: 'multipart/form-data',
            processData: false,
            contentType: false,
        };
        var formData = new FormData(this);
        getLoadingStatus();
        customAjaxCall(function(res) {
            customSweetAlert(function(result) {
                    console.log("result", result);
                    if (result.isDismissed == true && result.dismiss != 'timer') {
                        location.reload(true);
                    }
                    else if(result.isDenied == true){
                        window.open(res.customRedirectTo);
                        location.reload(true);
                    } else {
                        if (res.redirectTo == 'close' && res.call != '') {
                            console.log("heeeeeeeeeeeeeeeee", res.call);
                            closeSweetAlert();
                            window[res.call]();
                            // call(res.call);
                            $('.form_submit').trigger('reset');
                            console.log("called", res.call);
                        } else if (res.redirectTo == 'close') {
                            closeSweetAlert();
                        } else if (res.redirectTo == 'closeAndModalHide') {
                            closeSweetAlert();
                            $('.modal').modal('hide');
                        } else if (res.redirectTo == 'reload') {
                            location.reload();
                        } else {
                            closeSweetAlert();
                            if (typeof res.newTab != 'undefined') {
                                window.open(res.redirectTo);
                                location.reload(true);
                            } else {
                                window.location.href = res.redirectTo;
                            }
                        }
                        form_submit_reset();
                    }
                }, 'success', res.message, res.description, res.buttonShow, null, res.timer, res.cancelButton, res.showCustomButton, res.customButtonText);
        }, 'POST', $(this).attr('action'), formData, customConfig);
    });
    function getLoadingStatus(title = "Loading", html = "Please Wait") {
        Swal.fire({
            title: title,
            html: html,
            didOpen: () => {
                Swal.showLoading()
            }
        })
    }
    function closeSweetAlert() {
        Swal.close();
    }
    function customSweetAlert(callback, icon = 'success', title = 'Added', html = 'Data Inserted Successfully',
        showConfirmButton = false, position = 'center', timer = null, showCancelButton = false, showCustomButton=false, customButtonText='Custom') {
        Swal.fire({
            icon: icon,
            title: title,
            html: html,
            showCancelButton: showCancelButton,
            showConfirmButton: showConfirmButton,
            showDenyButton: showCustomButton,
            denyButtonText: customButtonText,
            position: position,
            timer: timer,
        }).then((result) => {
            callback(result);
        });
    }

    async function customAjaxCall(callback, method, url, data, customConfig) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var defConfig = {
            type: method,
            dataType: 'json',
            url: url,
            data: data,
            success: function(data) {
                callback(data);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                // callback(-1);
                if (jqXHR.status === 0) {
                    customSweetAlert(function() {
                        console.log(textStatus);
                    }, 'error', 'Oppps!', 'Not connect. Verify Network.', true, null, null);
                } else if (jqXHR.status == 404) {
                    customSweetAlert(function() {
                        console.log(textStatus);
                    }, 'error', 'Oppps!', 'Requested page not found.', true, null, null);
                } else if (jqXHR.status == 500) {
                    customSweetAlert(function() {
                        console.log(textStatus);
                    }, 'error', 'Oppps!', 'Internal Server Error.', true, null, null);
                } else if (jqXHR.status == 422) {
                    var object = jqXHR.responseJSON.errors,
                        result = Object.keys(object).reduce(function(r, k) {
                            return r.concat(object[k] + '<br>');
                        }, []);
                    customSweetAlert(function() {
                        console.log(jqXHR);
                    }, 'error', 'Oppps!', result.join(""), true, null, null);
                } else if (jqXHR.status == 421) {
                    customSweetAlert(function() {
                        // console.log(jqXHR);
                        let error_found_product = jqXHR.getResponseHeader('product');
                        if(typeof(error_found_product) != 'undefined'){
                            customValidationErrorCallback(error_found_product);
                        }
                    }, 'error', 'Oppps!', jqXHR.responseJSON.message, true, null, null);
                } else if (errorThrown === 'timeout') {
                    customSweetAlert(function() {
                        console.log(textStatus);
                    }, 'error', 'Oppps!', 'Time out error.', true, null, null);
                } else if (errorThrown === 'abort') {
                    customSweetAlert(function() {
                        console.log(textStatus);
                    }, 'error', 'Oppps!', 'Request aborted.', true, null, null);
                } else {
                    customSweetAlert(function() {
                        console.log(textStatus);
                        console.log(jqXHR);
                    }, 'error', 'Oppps!', 'Uncaught Error.', true, null, null);
                }
            }
        };
        if (typeof customConfig != 'undefined') {
            defConfig = Object.assign({}, defConfig, customConfig);
        }
        $.ajax(defConfig);
    }
    $(document).ready(function() {
        $('.select_2').select2();
        $(document).on('click', '.pagination a', function(e) {
            getLoader();
            e.preventDefault();
            customAjaxCall(function(res) {
                $('.commonListBody').html(res.body);
                $('.commonListPaginate').html(res.paginate);
            }, 'get', $(this).attr('href'))
        });
    });
    function getLoader() {
        $('.commonListBody').html(`<div class="d-flex justify-content-center align-items-center" style="min-height: 100px">
            <div class="spinner-border" style="color: #17a2b8!important" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>`);
    }
    function closeLoader() {
        $('defaultLoader').hide();
    }
    function form_submit_reset() {
        $('.form_submit').trigger('reset');
        $('.form_submit select').trigger('change');
        $('.row_id').val('');
    }

    function sweet_warning(title='Warning!!!', html=''){
        Swal.fire({
            // icon: 'warning',
            // title: title,
            // html: html,
            // showConfirmButton: false,
            // showCancelButton: true,
            // position: 'center',
            // timer: false,

            icon: 'warning',
            title: title,
            html: html,
            showConfirmButton: true,
            showCancelButton: false,
            position: 'center',
            timer: null,
            didOpen: () => {
                Swal.hideLoading()
            }
        });
    }

    function sweet_success(callback,title='Success', html=''){
        Swal.fire({
            icon: 'success',
            title: title,
            html: html,
            showConfirmButton: true,
            showCancelButton: false,
            position: 'center',
            timer: null,
            didOpen: () => {
                Swal.hideLoading()
            }
        }).then((result) => {
            callback(result);
        });;
    }

    function sweet_confirm(callback, title='Are You Sure?', html=''){
        Swal.fire({
            icon: 'warning',
            title: title,
            html: html,
            showConfirmButton: true,
            showCancelButton: true,
            position: 'center',
            timer: false,
            didOpen: () => {
                Swal.hideLoading()
            }
        }).then((result) => {
            callback(result);
        });
    }

    $(document).bind('keydown','Alt+Shift+s', function(){
        $('.shortcut_toggle').show();
    });

    const addNewDrawer = () => {
        $('#row_id').val(null);
        $('.form_submit').trigger('reset');
        $('.insert_drawer_full_page').addClass('open');
    }

    const hideAddNewDrawer = () => {
        $('.insert_drawer_full_page').removeClass('open');
    }

    const dontHideAddNewDrawer = (e) => {
        e.stopPropagation();
    }

    function remote_select(cls, defUrl, clear = true, placeholder = "Select") {
        var defClass = "." + cls;
        $(defClass).select2({
            minimumInputLength: 3,
            allowClear: clear,
            placeholder: placeholder,
            ajax: {
                url: defUrl,
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    return {
                        results: data
                    };
                },
                cache: true
            }
        });
    };
</script>
