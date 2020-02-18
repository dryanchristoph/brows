var active_image_index;
var clicked = false;

$( document ).ready(function() {

    $.typeahead({
        input: '.js-typeahead-search',
        minLength: 1,
        order: "asc",
        maxItem: 10,
        maxItemPerGroup: 5,
        dynamic: true,
        delay: 500,
        backdrop: {
            "background-color": "#fff"
        },
        template: function (query, item) {
     
            var color = "#777";
            if (item.status === "owner") {
                color = "#ff1493";
            }
            
            return '<span class="row">' +
                '<span class="avatar">' +
                    '<img src="{{avatar}}" class="search-avatar">' +
                "</span>" +
                '<span class="username">{{name}}</span>'
            "</span>"
        },
        emptyTemplate: "no result for {{query}}",
        group: {
            key: "group",
            template: function (item) {
                console.log(item);
                return item.group;
            }
        },
        display: ["id", "name", "avatar"],
        source: {
            Kategori: {
                display: "name",
                href: base_url+"/product/catalog?{{type}}={{id}}",
                ajax: function (query) {
                    return {
                        type: "POST",
                        url: base_url+"/search",
                        path: "data.categories",
                        data: {
                            q: "{{query}}",
                            type: 'categories',
                            '_token': $('meta[name="csrf-token"]').attr('content')
                        },
                        callback: {
                            done: function (data) {
                                return data;
                            }
                        }
                    }
                }
     
            },
            Barang: {
                display: "name",
                href: base_url+"/product/details?prod_id={{id}}",
                ajax: function (query) {
                    return {
                        type: "POST",
                        url: base_url+"/search",
                        path: "data.products",
                        data: {
                            q: "{{query}}",
                            type: 'products',
                            '_token': $('meta[name="csrf-token"]').attr('content')
                        },
                        callback: {
                            done: function (data) {
                                return data;
                            }
                        }
                    }
                }
     
            }
        },
        callback: {
            onClick: function (node, a, item, event) {
                // You can do a simple window.location of the item.href
                //alert(JSON.stringify(item));
     
            },
            onSendRequest: function (node, query) {
                //console.log('request is sent')
            },
            onReceiveRequest: function (node, query) {
                //console.log('request is received')
            }
        },
        debug: true
    });

    $('input#checkboxAgreement').click(function(){
        if($(this).prop('checked'))
            $('button#btn_register').removeAttr('disabled');
        else $('button#btn_register').attr('disabled','disabled');
    });

    //$('input.typeahead')

    $('[data-toggle="popover"]').popover({
        trigger: 'focus'
    });
    var startYear = new Date();
    startYear.setFullYear( startYear.getFullYear() - 80 );
    var endYear = new Date();
    endYear.setFullYear( endYear.getFullYear() - 15 );
    $('input#datepicker').datepicker({
        format: "dd M yyyy",
        keyboardNavigation: false,
        todayHighlight: true,
        startDate: startYear,
        endDate: endYear
    });

    if((segment1+'/'+segment2) == 'product/upload'){
        checkPrice();
    }

    $('select.cust_area').change(function(){
        search_data = $(this).val();
        type = $(this).attr('data-type');
        next = $(this).attr('data-next');
        prevtitle = '';
        $.ajax({
            url: base_url+'/account/getAddrArea',
            method: 'POST',
            beforeSend: function(){
                $('select#'+next).html('');

                if(next=='city'){
                    $('select#'+$('select#'+next).attr('data-next')).html('');
                    $('.selectpicker').selectpicker('refresh');
                    $('select#'+$('select#'+next).attr('data-next')).parent().find('div.filter-option-inner-inner')
                .html('Mohon tunggu <img src="'+base_url+'/resources/images/spinner.gif" class="spinner1" />');
                } else $('.selectpicker').selectpicker('refresh');
                

                $('select#'+next).parent().find('div.filter-option-inner-inner')
                .html('Mohon tunggu <img src="'+base_url+'/resources/images/spinner.gif" class="spinner1" />');
                
            },
            data: {type: type,search_data: search_data,'_token': $('meta[name="csrf-token"]').attr('content')},
            success: function(data){
                //console.log(data);
                var elements = $();
                $.each(data,function(index,value){
                    if(type=='province')
                        elements = elements.add('<option value="'+value[next+'_id']+'">'+value['type']+' '+value[next+'_name']+'</option>');
                    else elements = elements.add('<option value="'+value[next+'_id']+'">'+value[next+'_name']+'</option>');
                });
                $('select#'+next).html('');
                $('select#'+next).append(elements);

                $('.selectpicker').selectpicker('refresh');
            }
        });
    });

    $('input#prod_insurance').change(function(){
        if($(this).prop('checked')){
            if($('.container-insurance-cost-1 span.insurance-cost').html() !== '')
                $('.container-insurance-cost-1').removeClass('cd-hidden');
        } else {
            $('.container-insurance-cost-1').addClass('cd-hidden');
        }
        checkPrice();
    });

    $('input#input-harga-sewa').blur(function(){
        checkPrice();
    });

    $('input.autonumeric').autoNumeric('init');

    $('button#confirmDelete').on('shown.bs.popover', function () {
      // do something…
        //$('button.btn-confirm-delete').focus();
        $('div.popover .btn-confirm-delete').click(function(){
            prod_id = $('input[name="prod_id"]').val();
            img_id = $('div.product-previews-wrapper a.active').attr('data-index');

            $('form#deleteProductImage').ajaxForm({
                beforeSend: function() {
                    $('div#prdGallery100 .ezp-spinner').css('display','block');
                },
                data: {prod_id: prod_id, img_id: img_id},
                success: function(data){
                    slick_index = $('div.product-previews-wrapper div.slick-track a[data-index="'+img_id+'"]').attr('data-slick-index');
                    changeProductImage(data.imgurl,slick_index,true);
                    $('div#prdGallery100 .ezp-spinner').css('display','none');
                }
            }).submit();
      });

      $('div.popover .btn-popover-dismiss').click(function(){
        $('button#confirmDelete').popover('hide');
      });
    })

    $('input.uploadWithPreview').on("change",function(e){
    	var file = this.files[0];
		var fileType = file["type"];
		var validImageTypes = ["image/jpeg", "image/png"];
		if ($.inArray(fileType, validImageTypes) < 0) {
		     // invalid file type code goes here.
		} else $(this).parents().eq(1).find('img').attr('src', URL.createObjectURL(this.files[0]));
        
    });

    var bar = $('.bar');
    var percent = $('.percent');
    var status = $('#status');

    $('form.file-upload').ajaxForm({
        beforeSend: function() {
            status.empty();
            var percentVal = '0%';
            var posterValue = $('input[type=file]').fieldValue();
            bar.width(percentVal);
            percent.html(percentVal);
        },
        uploadProgress: function(event, position, total, percentComplete) {
            var percentVal = percentComplete + '%';
            bar.width(percentVal)
            percent.html(percentVal);
        },
        success: function() {
            var percentVal = 'Wait, Saving';
            bar.width(percentVal)
            percent.html(percentVal);
        },
        complete: function(xhr) {
            returndata = JSON.parse(xhr.responseText);

            if(typeof(returndata.imgurl) != "undefined" && returndata.imgurl !== null){
                $('#'+returndata.imgID).css('background-image','url('+returndata.imgurl+')');
                $('img.imgprofile-menu').attr('src',returndata.imgurl);
            } else window.location.href = base_url+"/account/verification";

            status.html(xhr.responseText);
            console.log(xhr.responseText);
            //alert('base url = '+base_url);
            
        }
    });

    $('input#imageUpload').change(function(){
        //var image_index = $('div#previewsGallery100 a.active').index()+1;
        active_image_index = $('div#previewsGallery100 a.active').index();
        $(this).parent().submit();
    });

    $('form#uploadProductImage').ajaxForm({
        beforeSend: function() {
            $('div#prdGallery100 .ezp-spinner').css('display','block');
        },
        data: { image_index: function(){return $('div#previewsGallery100 a.active').attr('data-index');} },
        success: function() {
            var percentVal = 'Wait, Saving';
            bar.width(percentVal);
            percent.html(percentVal);
        },
        complete: function(xhr) {
            returndata = JSON.parse(xhr.responseText);
            
            changeProductImage(returndata.imgurl,returndata.image_index,false);

            $('div#prdGallery100 .ezp-spinner').css('display','none');
        }
    });

    $('div.product-previews-wrapper div.product-previews-carousel a').click(function(){
        var attr = $(this).attr('data-index');
        
        if (typeof attr !== typeof undefined && attr !== false) {
            $('div.prd-block_main-image-links button.btn').removeClass('cd-hidden');
        } else $('div.prd-block_main-image-links button.btn').addClass('cd-hidden');
    });

    $('input#uploadPrdImage').change(function(){
        $(this).parents().eq(1).submit();
    });

    setCountdownOTP();

    $('div#my-signin2').click(function(){
        clicked = true;
    });

});

function changeProductImage(imgurl,index,is_placeholder){
    $('.prd-block_main-image-holder .zoomWrapper img').attr('src',imgurl);
    $('.prd-block_main-image-holder .zoomWrapper img').attr('data-zoom-image',imgurl);
    $('div.zoomContainer div.zoomWindowContainer div').css('background-image','url("'+imgurl+'")');
    $('div.product-previews-wrapper div.slick-track a.active').attr('data-image',imgurl);
    $('div.product-previews-wrapper div.slick-track a.active').attr('data-zoom-image',imgurl);
    $('div.product-previews-wrapper div.slick-track a.active img').attr('src',imgurl);
    if(is_placeholder){
        $('div.prd-block_main-image-links button.btn').addClass('cd-hidden');
        $('div.product-previews-wrapper div.slick-track a.active').removeAttr('data-index');
        $('div.prd-block_main-image-links button.btn').addClass('cd-hidden');
    } else{
        $('div.product-previews-wrapper div.slick-track a.active').attr('data-index',index);
        $('div.prd-block_main-image-links button.btn').removeClass('cd-hidden');
    }
}

function validate(formData, jqForm, options) {
	console.log(form);
    var form = jqForm[0];
    if (!form.file.value) {
        alert('File not found');
        return false;
    }
}

function checkPrice(){
    rent_price = $('input#input-harga-sewa').val().replace(/[^\d.-]/g, '');
    is_insuranced = $('input#prod_insurance').prop('checked');
    $.ajax({
        url: base_url+'/product/countPrice',
        method: 'POST',
        beforeSend: function(){
            if(is_insuranced)
                $('div.container-insurance-cost div.loader-wrap').removeClass('cd-hidden');
            
            $('.container-insurance-cost-1').addClass('cd-hidden');
            $('.prd-block_actions div.loader-wrap').removeClass('cd-hidden');
            $('div.totalprice-wrap').addClass('cd-hidden');
        },
        data: { rent_price: rent_price,
                is_insuranced: is_insuranced,
            '_token': $('meta[name="csrf-token"]').attr('content')},
        context: document.body
    }).success(function(data) {
        if(data.is_empty){
            $('.container-insurance-cost-1').addClass('cd-hidden');
        } else {
            $('.container-insurance-cost-1 span.insurance-cost').html(data.insurance_cost);
            if(is_insuranced)
                $('.container-insurance-cost-1').removeClass('cd-hidden');
        }
        $('div.container-insurance-cost div.loader-wrap').addClass('cd-hidden');
        $('.prd-block_actions div.loader-wrap').addClass('cd-hidden');
        $('div.totalprice-wrap').removeClass('cd-hidden');

        $('.prd-block_price--actual').html(data.total_cost);
    });
}

function setCountdownOTP(){
    //"Jan 5, 2021 15:37:25"
    //var countDownDate = new Date($('p#time_left').html()).getTime();
    //alert(countDownDate);
    //distance = $('p#time_left').html();
    //minutes = Math.floor(distance / (1000 * 60 * 60 * 24));
    //alert(distance);
    //alert(distance % 60);
    if($('#countdown_otp').length){
        var distance = $('p#time_left').html();
        // Update the count down every 1 second
        var x = setInterval(function() {

          // Get today's date and time
          var now = new Date().getTime();

          // Find the distance between now and the count down date
          //var distance = countDownDate - now;
          //alert(distance);

          // Time calculations for days, hours, minutes and seconds
          /*
          var days = Math.floor(distance / (1000 * 60 * 60 * 24));
          var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
          var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
          var seconds = Math.floor((distance % (1000 * 60)) / 1000); */
          minutes = Math.floor(distance/60);
          seconds = distance % 60;
          /*
          console.log('minute = ');
          console.log(distance);
          console.log(Math.floor(distance/60));
          console.log(distance % 60);*/

          // Display the result in the element with id="demo"
          document.getElementById("countdown_otp").innerHTML = minutes + "m " + seconds + "s ";
          distance = distance - 1;

          // If the count down is finished, write some text
          if (distance < 0) {
            $('div#btn_submit_otp').remove();
            clearInterval(x);
            document.getElementById("countdown_otp").innerHTML = "EXPIRED";
          }
        }, 1000);
    }
}

function ClickLogin(){
    clicked=true;
}

function onSignIn(googleUser) {
    
}

function onSuccess(googleUser) {
    if (clicked) {
        // Useful data for your client-side scripts:
        var profile = googleUser.getBasicProfile();

        var arr_profile = {};

        console.log('name = '+profile.getName());
        
        arr_profile['id'] = profile.getId();
        arr_profile['name'] = profile.getName();
        arr_profile['cust_firstname'] = profile.getGivenName();
        arr_profile['cust_lastname'] = profile.getFamilyName();
        arr_profile['imageUrl'] = profile.getImageUrl();
        arr_profile['cust_email'] = profile.getEmail();

        request_param = $.param(arr_profile);

        // The ID token you need to pass to your backend:
        var id_token = googleUser.getAuthResponse().id_token;
        console.log("ID Token: " + id_token);

        var auth2 = gapi.auth2.getAuthInstance();
        auth2.signOut().then(function () {
          console.log('User signed out.');
        });

        //console.log(profile);

        window.location.href = base_url+'/account/googleAuthSuccess?'+request_param;
    }
}

function onFailure(error) {
    console.log(error);
}

function renderButton() {
  gapi.signin2.render('my-signin2', {
    'scope': 'profile email',
    'width': 240,
    'height': 36,
    'longtitle': true,
    'theme': 'dark',
    'onsuccess': onSuccess,
    'onfailure': onFailure
  });
}