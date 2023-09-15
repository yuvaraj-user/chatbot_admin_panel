<?php include('layout/header.php'); ?>
<?php
$res_query = mysqli_query($conn, "SELECT 
cud.user_name,
cq.question,
cuh.answer,
cuh.chat_user_id,
cuh.created_at
FROM chat_user_history cuh
LEFT JOIN chat_user_detail cud ON cud.id = cuh.chat_user_id
LEFT JOIN chatbot_questions cq ON cq.id = cuh.question_id group by cuh.chat_user_id order by cuh.created_at DESC;");

if (isset($_POST["export_id"])) {
    require_once 'assets/libs/PHPExcel-1.8/Classes/PHPExcel.php';
    $userid = $_POST["export_id"];

    $user_datas = mysqli_query($conn, "SELECT * from chat_user_detail where id=" . $userid . ";");
    $res = mysqli_query($conn, "SELECT 
    cud.user_name,
    cud.email,
    cud.phone_no,
    cq.question,
    cuh.answer,
    cuh.created_at
    FROM chat_user_history cuh
    LEFT JOIN chat_user_detail cud ON cud.id = cuh.chat_user_id
    LEFT JOIN chatbot_questions cq ON cq.id = cuh.question_id where cuh.chat_user_id = " . $userid . ";");

    $objPHPExcel = new PHPExcel();
    $objPHPExcel->getActiveSheet()->setShowGridlines(false);
    $borderarr = array(
        'borders' => array(
            'allborders' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN,
            )
        )
    );
    $objPHPExcel->getActiveSheet()->getStyle('A1:B1')->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle('A1:B1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A1:B1')->applyFromArray(
        array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => '0000ff')
            )
        )
    );
    $objPHPExcel->getActiveSheet()->getStyle('A1:B1')->applyFromArray(array(
        'font'  => array(
            'color' => array('rgb' => 'FFFFFF'),
        )
    ));

    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A1', 'Bot Question')
        ->setCellValue('B1', 'User Answer');

    $user_det = mysqli_fetch_assoc($user_datas);
    $userdata = [];
    $filename = $user_det['user_name'];
    $userdata[] = "UserName  : " . $user_det['user_name'];
    $userdata[] = "UserEmail : " . $user_det['email'];
    $userdata[] = "UserPhone : " . $user_det['phone_no'];
    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A2', "Hi 👋! Got any questions? I’m happy to help")
        ->setCellValue('B2', implode(' , ', $userdata));

    $objPHPExcel->getActiveSheet()->getStyle("A1:B1")->applyFromArray($borderarr);
    $objPHPExcel->getActiveSheet()->getStyle("A2:B2")->applyFromArray($borderarr);

    $i = 3;
    while ($value = mysqli_fetch_assoc($res)) {
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A' . $i, $value['question'])
            ->setCellValue('B' . $i, $value['answer']);
        $objPHPExcel->getActiveSheet()->getColumnDimension("A")->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension("B")->setAutoSize(true);

        $objPHPExcel->getActiveSheet()->getStyle("A" . $i . ":" . "B" . $i)->applyFromArray($borderarr);
        $i++;
    }

    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    ob_end_clean();
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="' . $filename . date('d-m-y') . '.xlsx"');
    header('Cache-Control: max-age=0');


    $objWriter->save('php://output');
    die();
}

if (isset($_POST['user_id'])) {
    chat_history_load($conn, $_POST['user_id']);
}

if (isset($_POST['from'])) {
    if ($_POST['from'] == "onload") {
        $user_id = mysqli_fetch_assoc($res_query)['chat_user_id'];
        chat_history_load($conn, $user_id);
    }
}

function chat_history_load($conn, $user_id)
{
    $result = mysqli_query($conn, "SELECT 
    cq.question,
    cud.user_name,
    cud.email,
    cud.phone_no,
    cuh.answer,
    cuh.chat_user_id,
    cuh.created_at
    FROM chat_user_history cuh
    LEFT JOIN chat_user_detail cud ON cud.id = cuh.chat_user_id
    LEFT JOIN chatbot_questions cq ON cq.id = cuh.question_id where cuh.chat_user_id = " . $user_id . ";");
    $template = "";
    $i = 1;
    while ($chat_history = mysqli_fetch_assoc($result)) {
        if ($i == 1) {
            $template .=  '<div class="p-4 border-bottom text-success text-capitalize" style="background-color: #eceff1;"><div class="row">
    <div class="col-md-4 col-9">
        <h5 class="font-size-15 mb-1">' . $chat_history['user_name'] . '</h5>
        <h5 class="font-size-12 mb-1" style="width: 400px;">Mail id :' . $chat_history['email']. '</h5>
        <h5 class="font-size-12 mb-1">Phone no :' . $chat_history['phone_no']. '</h5>
    </div><div class="col-md-8 col-3 text-end">
        <div><form method="POST" action="chat_history.php"><input type="hidden" name="export_id" value=' . $chat_history['chat_user_id'] . '><button type="submit" class="btn btn-primary font-size-15 mb-1" ></i>Export Chat</button></form></div>
    </div></div></div>';
            $template .=  '<div><div class="chat-conversation p-3"><ul class="list-unstyled mb-0" data-simplebar style="max-height:486px;">';
        }
        if ($i == 1) {
            $template .= '<li>
                <div class="chat-day-title">
                    <span class="title">' . date('d-m-y', strtotime($chat_history['created_at'])) . '</span>
                </div>
            </li>';
        }
        $template .= '
            <li>
                <div class="conversation-list">
                    <div class="ctext-wrap">
                        <div class="conversation-name">Chatbot</div>
                        <p>' . $chat_history['question'] . '</p>
                        <p class="chat-time mb-0"><i class="bx bx-time-five align-middle me-1"></i>' . date('h:i A', strtotime($chat_history['created_at'])) . '</p>
                    </div>
    
                </div>
            </li>
    
            <li class="right">
                <div class="conversation-list">
                    <div class="ctext-wrap">
                        <div class="conversation-name">' . $chat_history['user_name'] . '</div>
                        <p>'
            . $chat_history['answer'] .
            '</p>
    
                        <p class="chat-time mb-0"><i class="bx bx-time-five align-middle me-1"></i>' . date('h:i A', strtotime($chat_history['created_at'])) . '</p>
                    </div>
                </div>
            </li>';
        if ($i == mysqli_num_rows($result)) {
            $template .= '</ul></div></div>';
        }
        $i++;
    }
    echo $template;
    die();
}


?>
<?php include('layout/sidemenu.php'); ?>

<!-------------- main content-->
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Chat</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="d-lg-flex">
                <div class="chat-leftsidebar me-lg-4">
                    <div class="">
                        <div class="chat-leftsidebar-nav">
                            <div class="tab-content">
                                <div class="tab-pane show active" id="chat">
                                    <div>
                                        <ul class="list-unstyled chat-list" data-simplebar style="max-height: 410px;">
                                            <?php while ($row = mysqli_fetch_assoc($res_query)) { ?>
                                                <li class="active user-tab" id="<?php echo $row['chat_user_id']; ?>">
                                                    <a href="javascript: void(0);">
                                                        <div class="d-flex">
                                                            <div class="flex-grow-1 overflow-hidden">
                                                                <h5 class="text-truncate font-size-14 mb-1 text-capitalize user_name" style="font-size: 600;"><?php echo $row['user_name']; ?></h5>
                                                                <p class="text-truncate mb-0 last_message"><?php echo $row['answer']; ?></p>
                                                            </div>
                                                            <div class="font-size-14 last_message_time"><?php echo date('h:i A', strtotime($row['created_at'])); ?></div>
                                                        </div>
                                                    </a>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </div>

                                <div class="tab-pane" id="groups">
                                    <h5 class="font-size-14 mb-3">Groups</h5>
                                    <ul class="list-unstyled chat-list" data-simplebar style="max-height: 410px;">
                                        <li>
                                            <a href="javascript: void(0);">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0 me-3">
                                                        <div class="avatar-xs">
                                                            <span class="avatar-title rounded-circle bg-primary bg-soft text-primary">
                                                                G
                                                            </span>
                                                        </div>
                                                    </div>

                                                    <div class="flex-grow-1">
                                                        <h5 class="font-size-14 mb-0">General</h5>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="javascript: void(0);">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0 me-3">
                                                        <div class="avatar-xs">
                                                            <span class="avatar-title rounded-circle bg-primary bg-soft text-primary">
                                                                R
                                                            </span>
                                                        </div>
                                                    </div>

                                                    <div class="flex-grow-1">
                                                        <h5 class="font-size-14 mb-0">Reporting</h5>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="javascript: void(0);">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0 me-3">
                                                        <div class="avatar-xs">
                                                            <span class="avatar-title rounded-circle bg-primary bg-soft text-primary">
                                                                M
                                                            </span>
                                                        </div>
                                                    </div>

                                                    <div class="flex-grow-1">
                                                        <h5 class="font-size-14 mb-0">Meeting</h5>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="javascript: void(0);">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0 me-3">
                                                        <div class="avatar-xs">
                                                            <span class="avatar-title rounded-circle bg-primary bg-soft text-primary">
                                                                A
                                                            </span>
                                                        </div>
                                                    </div>

                                                    <div class="flex-grow-1">
                                                        <h5 class="font-size-14 mb-0">Project A</h5>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="javascript: void(0);">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0 me-3">
                                                        <div class="avatar-xs">
                                                            <span class="avatar-title rounded-circle bg-primary bg-soft text-primary">
                                                                B
                                                            </span>
                                                        </div>
                                                    </div>

                                                    <div class="flex-grow-1">
                                                        <h5 class="font-size-14 mb-0">Project B</h5>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="tab-pane" id="contacts">
                                    <h5 class="font-size-14 mb-3">Contacts</h5>

                                    <div data-simplebar style="max-height: 410px;">
                                        <div>
                                            <div class="avatar-xs mb-3">
                                                <span class="avatar-title rounded-circle bg-primary bg-soft text-primary">
                                                    A
                                                </span>
                                            </div>

                                            <ul class="list-unstyled chat-list">
                                                <li>
                                                    <a href="javascript: void(0);">
                                                        <h5 class="font-size-14 mb-0">Adam Miller</h5>
                                                    </a>
                                                </li>

                                                <li>
                                                    <a href="javascript: void(0);">
                                                        <h5 class="font-size-14 mb-0">Alfonso Fisher</h5>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="mt-4">
                                            <div class="avatar-xs mb-3">
                                                <span class="avatar-title rounded-circle bg-primary bg-soft text-primary">
                                                    B
                                                </span>
                                            </div>

                                            <ul class="list-unstyled chat-list">
                                                <li>
                                                    <a href="javascript: void(0);">
                                                        <h5 class="font-size-14 mb-0">Bonnie Harney</h5>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="mt-4">
                                            <div class="avatar-xs mb-3">
                                                <span class="avatar-title rounded-circle bg-primary bg-soft text-primary">
                                                    C
                                                </span>
                                            </div>

                                            <ul class="list-unstyled chat-list">
                                                <li>
                                                    <a href="javascript: void(0);">
                                                        <h5 class="font-size-14 mb-0">Charles Brown</h5>
                                                    </a>
                                                    <a href="javascript: void(0);">
                                                        <h5 class="font-size-14 mb-0">Carmella Jones</h5>
                                                    </a>
                                                    <a href="javascript: void(0);">
                                                        <h5 class="font-size-14 mb-0">Carrie Williams</h5>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="mt-4">
                                            <div class="avatar-xs mb-3">
                                                <span class="avatar-title rounded-circle bg-primary bg-soft text-primary">
                                                    D
                                                </span>
                                            </div>

                                            <ul class="list-unstyled chat-list">
                                                <li>
                                                    <a href="javascript: void(0);">
                                                        <h5 class="font-size-14 mb-0">Dolores Minter</h5>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>


                    </div>
                </div>

                <div class="w-100 user-chats">
                    <div class="card chat_content">

                    </div>
                </div>

            </div>
            <!-- end row -->

        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->



</div>

<!-------------- main content end-->
<?php include('layout/footer-links.php'); ?>
<script>
    $(document).ready(function() {
        $.ajax({
            url: 'chat_history.php',
            method: "POST",
            data: {
                from: "onload"
            },
            success: function(res) {
                $('.chat_content').html(res);
                $('.user-tab:first a').css('background-color', '#2a3042');
                $('.user-tab:first .user_name:first,.last_message:first,.last_message_time:first').css('color', '#eceff1');
            }
        });
    });

    $(document).on('click', '.user-tab', function() {
        var user_id = $(this).attr('id');
        $('.user-tab a').css('background-color', '');
        $('.user-tab .user_name,.last_message,.last_message_time').css('color', '#1a1a1a');
        $(this).children('a').css('background-color', '#2a3042');
        $(this).find('.user_name,.last_message,.last_message_time').css('color', '#eceff1');
        $.ajax({
            url: 'chat_history.php',
            method: "POST",
            data: {
                user_id: user_id
            },
            success: function(res) {
                $('.chat_content').html(res);
            }
        });
    });

    $(document).on('click', '.export', function() {
        var user_id = $(this).attr('data-user-id');
        $.ajax({
            url: 'chat_history.php',
            method: "POST",
            data: {
                export_id: user_id
            },
            success: function(res) {}
        });
    });
</script>