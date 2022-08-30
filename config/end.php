<div class="content-backdrop fade"></div>
    </div>
    </div>
    </div>
    <div class="layout-overlay layout-menu-toggle"></div>
    <div class="drag-target"></div>
    </div>
    <div class="contact-button-group">
        <a role="button" class="contact-head" href="javascript:void(0)">
            <i class="fa fa-headphones contact-head-icon"></i>
            <i class="fa fa-times contact-head-icon d-none"></i>
            <div class="contact-head-label">Liên hệ & hỗ trợ</div>
        </a>

        <a role="button" class="contact-button zalo-button button-closed" href="https://zalo.me/<?=$LTT->site('phone_zalo');?>"
            target="_blank" rel="nofollow">
            <i aria-hidden="true" class="fa fa-comment button-icon"></i>
            <div class="contact-label">Nhắn tin Zalo</div>
        </a>

        <a role="button" class="contact-button messenger-button button-closed"
            href="https://www.facebook.com/<?=$LTT->site('id_page_chat');?>" target="_blank" rel="nofollow">
            <i aria-hidden="true" class="fa fa-life-ring button-icon"></i>
            <div class="contact-label">Nhắn tin Page</div>
        </a>

    </div>


<?php $status_site = $LTT->get_row(" SELECT * FROM `setting` WHERE `url_config`='" . $url_site_name . "'");
if ($status_site['status'] == "wait") {
    header('Location: /');
    exit;
} ?>


</div>
<footer class="content-footer">
<div class="text-center">© 2022 <a href="#"><?= $LTT->site('ten_website'); ?></a> Hệ thống thiết kế và vận hành bởi TAOWEBGAME.COM</div>
</footer>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pusher/7.0.3/pusher.min.js"></script>
<script>
    const pusher = new Pusher('8424c10da800c48a00cf', {
        cluster: 'ap1'
    });
</script>
<script>
function getUID(elm) {
    $('#buy').prop("disabled", true);
    setTimeout(() => {
        let link = $('[name=' + elm + ']').val();
        if (!isURL(link)) {
            $('#buy').prop("disabled", false);
            return;
        }
        $('[name=' + elm + ']').prop("disabled", true).val('Đang xử lý');
        $.ajax({
            type: "GET",
            url: "/api/tool/get-uid-fb",
            data: {
                link
            },
            dataType: "json",
            success: function(response) {
                if (response.status === true) {
                    $('[name=' + elm + ']').prop("disabled", false).val(response.data);
                } else {
                    $('[name=' + elm + ']').prop("disabled", false).val('');
                }
                $('#buy').prop("disabled", false);
            }
        });
    }, 100);
}


function detailServer(text) {
    $('#detailServer').show().html(`<div class="alert bg-danger text-white" role="alert">
                <h4>Thông tin máy chủ</h4>
                - <b>${text}</b></div>`);
}
</script>

<script>

function bill() {
    let server = $('input[name=server]:checked');
    let detail = server.attr('detail');
    server = server.val();
    if (!server) return;
    detailServer(detail);
    let soluong = $('[name=soluong]').val();
    <?php foreach ($getrate as $runrate) { ?>
    if (server == '<?= $runrate['server_service'] ?>') {
        var price = <?= $runrate['rate_service'] ?>;
        var price2 = <?= $runrate['rate_service'] + ($runrate['rate_service'] * $chietkhau / 100) ?>;
    }
    <?php } ?>
    let total_payment = Math.round(soluong * price2);
    $('#total_payment').html(Intl.NumberFormat().format(total_payment));
}
$(document).ready(function() {
    bill();
});
</script>



<script src="https://code.jquery.com/jquery.min.js"></script>


<script>
    $('body').load(
        $('.preloader').fadeOut(750)
    );
</script>
<script>
    $(document).ready(function() {

        $('#modalSystem').modal('show');

    });

    function closeModalSystem() {
        setCookie('modalSystem', true, 1);
        $('#modalSystem').modal('hide');
    }
</script>

</body>

</html>