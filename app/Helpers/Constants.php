<?php
define('INVOICE_TYPE_TH', serialize(array("-"=>'- ประเภท -', 1 =>'รายรับ', 2 => 'รายจ่าย' )));
define('INVOICE_TYPE_EN', serialize(array("-"=>'- Type -', 1 =>'Income', 2 => 'Expend' )));

define('INVOICE_INCOME_CATE_TH', serialize(array(
    "-" => '- หมวดหมู่ -',
    1   => 'ค่าส่วนกลาง',
    20  => 'ค่าส่วนกลางค้างชำระ',
    21  => 'ค่าเช่าห้อง/เช่าพื้นที่ส่วนกลาง',
    2   => 'ค่าสติ๊กเกอร์/การ์ดประตูอัตโนมัติ',
    3   => 'เงินสนับสนุน กิจกรรมจากเอกชน',
    4   => 'เงินบริจาคสำหรับลูกบ้าน',
    5   => 'เงินค่าที่จอดรถ',
    6   => 'เงินประกันค่าเสียหาย',
    7   => 'ค่าปรับ',
    8   => 'ค่าน้ำประปา',
    9   => 'ค่าไฟฟ้า',
    14  => 'ค่าโทรศัพท์',
    15  => 'ค่าอินเตอร์เน็ต',
    18  => 'ค่าเคเบิลทีวี',
    10  => 'รับเงินล่วงหน้า',
    11  => 'คืนเงินสดย่อย',
    12  => 'ยอดหนี้ยกมา',
    13  => 'เงินคงเหลือยกมา',
    16  => 'เบี้ยประกัน',
    17  => 'เงินระดมทุน',
    19  => 'เงินชำระเกิน',
    22  => 'ค่าทาสีภายนอกอาคาร',
    23  => 'ค่าบริการแจกเอกสาร-ใบปลิว',
    24  => 'ค่าสารธารณูปโภค',
    25  => 'เงินกองทุน',
    26  => 'ค่าธรรมเนียมเช็ค',
    27  => 'เงินค้ำประกันตกแต่ง',
    28  => 'ค่าใช้บริการสาธารณะ',
    29  => 'ค่าปรับปรุงอาคาร/สถานที่',
    30 => 'ส่วนลด',
    31 => 'ค่ารักษามิเตอร์',
    32 => 'ค่าบำบัดน้ำเสีย',
    33 => 'ค่าบริการจัดเก็บขยะ',
    34 => 'ค่าทำความสะอาด',
    35 => 'ค่าติดตามทวงถาม',
    36 => 'ค่าบริการงานซ่อม',
    37 => 'เงินปันผล/ดอกเบี้ย',
    38 => 'ค่าเช่าพื้นที่ป้าย',
    99  => 'อื่นๆ')));
define('INVOICE_INCOME_CATE_EN', serialize(array(
    "-" => '- Category -',
    1   => 'Common Fees',
    20  => 'Common Fees overdue',
    21  => 'Room Rental/Common Area Rental',
    2   => 'Vehicle Sticker/Keycard Fees',
    3   => 'Sponsor Fund',
    4   => 'Community Donation Fund',
    5   => 'Parking Fees',
    6   => 'Security Deposit',
    7   => 'Invoice fine',
    8   => 'Water',
    9   => 'Electric',
    14  => 'Telephone Service',
    15  => 'Internet Service',
    18  => 'Cable TV Service',
    10  => 'Early expense',
    11  => 'Returning petty cash',
    12  => 'Brought forward debt',
    13  => 'Brought forward balance',
    16  => 'Building insurance',
    17  => 'Fundraiser money',
    19  => 'Paid over',
    22  => 'Building Painting',
    23  => 'Advertising Fees',
    24  => 'Public utility Fees',
    25  => 'Sinking Fund',
    26  => 'Cheque fee',
    27  => 'Decorative insurance',
    28  => 'Facility service charge',
    29  => 'Place/Building Maintenance',
    30 => 'Discount',
    31 => 'Water Maintainance Fee',
    32 => 'Waste Water Treatment Fee',
    33 => 'Garbage Service',
    34 => 'Cleaning Service',
    35 => 'Call charge',
    36 => 'Maintenance Service',
    37 => 'Dividend/Interest',
    38 => 'Billboards Rental',
    99  => 'Other')));

define('INVOICE_EXPENSE_CATE_TH', serialize(array(
    "-" => '- หมวดหมู่ -',
    29  => 'ค่าจ้างบริหารนิติบุคคล',
    2   => 'ค่าน้ำส่วนกลาง',
    7   => 'ค่าไฟฟ้าส่วนกลาง',
    3   => 'ค่าบำรุงรักษาสวน',
    4   => 'ค่าจัดการขยะ',
    5   => 'ค่าใช้จ่ายในสำนักงานออฟฟิศส่วนกลาง',
    6   => 'เงินสดย่อย',
    8   => 'ค่าบำรุงรักษาอาคาร',// เปลี่ยนเป็น "ค่าบำรุงรักษาอาคาร" จากเดิมเป็น "ค่าบริหารจัดการอาคาร"
    9   => 'ค่าโทรศัพท์',
    10  => 'ค่าอินเตอร์เน็ต',
    11  => 'ค่าจ้างงานรักษาความสะอาด',
    12  => 'ค่าบริการดูแลสระว่ายน้ำ',
    13  => 'ค่าเคเบิลทีวี',
    14  => 'ค่าจ้างงานรักษาความปลอดภัย',
    15  => 'ค่าใช้จ่ายพื้นที่ส่วนกลาง',// เปลี่ยนเป็น "ค่าใช้จ่ายพื้นที่ส่วนกลาง" จากเดิมเป็น "ค่าบริหารจัดการดูแลส่วนกลาง"
    16  => 'ค่าใช้จ่ายเดินทางและที่พัก',
    17  => 'ค่าทำบัญชี',
    18  => 'ค่าสอบบัญชี',
    19  => 'ค่าเสื่อมราคาทรัพย์สิน',
    20  => 'ค่าใช้จ่ายเบ็ดเตล็ด',
    21  => 'ค่าใช้จ่ายงานช่าง',
    22  => 'ค่าธรรมเนียมธนาคาร',
    23  => 'ค่าถ่ายเอกสาร',
    24  => 'ค่าดูแลสระว่ายน้ำและซ่อมแซม',
    25  => 'ค่าเบี้ยประกันภัย',
    26  => 'เงินสมทบประกันสังคม',
    27  => 'เคมีภัณฑ์',
    28  => 'นำส่งภาษีหัก ณ ที่จ่าย',
    1   => 'ค่าลูกจ้าง/พนักงานนิติบุคคล',
    30  => 'เงินประกันค่าเสียหาย',
    31  => 'ค่าบริการกำจัดแมลง',
    32  => 'บำรุงรักษาลิฟต์',
    33  => 'ค่าสินทรัพย์ส่วนกลาง',
    34  => 'เงินประกันการใช้ไฟฟ้า',
    35  => 'ค่าธรรมเนียมเช็ค',
    99  => 'อื่นๆ' )));

define('INVOICE_EXPENSE_CATE_EN', serialize(array(
    "-" => '- Category -',
    1   => 'Julistic Officer Salary',
    2   => 'Water',
    7   => 'Electric',
    3   => 'Gardener',
    4   => 'Garbage Collection Fees',
    5   => 'Julistic Office Tools',
    6   => 'Petty Cash',
    8   => 'Property Management Fee',
    9   => 'Telephone Service',
    10  => 'Internet Service',
    11  => 'Cleaning Service',
    12  => 'Swimming Pool Maintanance Service',
    13  => 'Cable TV Service',
    14  => 'Security Service',
    15  => 'Central management cost',
    16  => 'Travel expenses and accommodation',
    17  => 'Accounting',
    18  => 'Audit fees',
    19  => 'Depreciation ',
    20  => 'Miscellaneous expense',
    21  => 'Maintenance service',
    22  => 'Bank fees',
    23  => 'Copy fee',
    24  => 'Pool maintenance',
    25  => 'Insurance premiums',
    26  => 'Contribution to social security',
    27  => 'Chemical',
    28  => 'Deliver Withholding tax',
    29  => 'Executive fee',
    30  => 'Security Deposit',
    31  => 'Insecticide Fee',
    32  => 'Elevator maintenance',
    33  => 'Property Asset',
    34  => 'Electric insurance',
    35  => 'Cheque fee',
    99  => 'Other')));

define('INVOICE_STATUS_TH', serialize(array("" => '- สถานะ -', 0 =>'ค้างชำระ', 1 => 'รอการตรวจสอบ',2 =>  'ชำระแล้ว',3 =>  'ไม่ผ่านการตรวจสอบ',4 =>  'ยกเลิก')));
define('INVOICE_STATUS_EN', serialize(array("" => '- Status -', 0 =>'Waiting', 1 => 'Confirm',2 =>  'Success',3 => "Reject",4 =>  'Cancel')));

define('VEHICLE_TYPE_TH', serialize(array('ประเภท','รถยนต์','รถจักรยานยนต์','รถจักรยาน','อื่นๆ')));
define('VEHICLE_TYPE_EN', serialize(array('Type','Truck','Motorcycle','Bicycle','Other')));

define('PET_TYPE_EN',serialize(array('Type','Dog','Cat','Bird','Fish','Other')));
define('PET_TYPE_TH',serialize(array('ประเภท','สุนัข','แมว','นก','ปลา','อื่นๆ')));

define('PROPERTY_TYPE_EN',serialize(array('Property type','Housing estate/Village','Hotel/Rented room','Condo','Other')));
define('PROPERTY_TYPE_TH',serialize(array('ประเภทอาคาร','บ้านจัดสรร','ห้องพัก/โรงแรม/ห้องเช่า','คอนโด','อื่นๆ')));

define('BANK_LIST_TH',serialize(array(
        ''=>'เลือกธนาคาร',
        "KrungSri"=>"ธนาคารกรุงศรีอยุธยา",
        "BBL"=>"ธนาคารกรุงเทพ",
        "KTB"=>"ธนาคารกรุงไทย",
        "KBank"=>"ธนาคารกสิกร",
        "CIMBT"=>"ธนาคารซีไอเอ็มบีไทย",
        "TMB"=>"ธนาคารทหารไทย",
        "TISCO"=>"ธนาคารทิสโก้",
        "THBK"=>"ธนาคารธนชาติ",
        "UOB"=>"ธนาคารยูโอบี",
        "SCBL"=>"ธนาคารสแตนดาร์ดชาร์เตอร์ด",
        "GSB"=>"ธนาคารออมสิน",
        "GHB"=>"ธนาคารอาคารสงเคราะห์",
        "TIBT"=>"ธนาคารอิสลาม",
        "KKPB"=>"ธนาคารเกียรตินาคิน",
        "BAAC"=>"ธนาคารเพื่อการเกษตรและสหกรณ์การเกษตร",
        "LHBANK"=>"ธนาคารแลนด์ แอนด์ เฮ้าท์",
        "SCB"=>"ธนาคารไทยพาณิชย์",
        "ICBC"=>"ธนาคารไอซีบีซี")
));

define('BANK_LIST_EN',serialize(array(
        ''=>'Select Bank',
        "KrungSri"=>"Krung Sri Bank",
        "BBL"=>"Bangkok Bank",
        "KTB"=>"Krung Thai Bank",
        "KBank"=>"Kasikorn Bank",
        "CIMBT"=>"CIMB Thai Bank",
        "TMB"=>"TMB Bank",
        "TISCO"=>"Tisco Bank",
        "THBK"=>"Thanachart Bank",
        "UOB"=>"UOB Bank",
        "SCBL"=>"Standard Chartered Bank",
        "GSB"=>"Government Savings Bank",
        "GHB"=>"Government Housing Bank",
        "TIBT"=>"Islamic Bank",
        "KKPB"=>"Kiatnakin Bank",
        "BAAC"=>"Bank for Agriculture and Agricultural Cooperatives",
        "LHBANK"=>"Land And Houses Retail Bank",
        "SCB"=>"Siam Commercial Bank",
        "ICBC"=>"ICBC Bank")
));

define('ACCOUNT_TYPE_EN',serialize(array('Account Type','Saving Account','Current account','Fixed deposit account')));
define('ACCOUNT_TYPE_TH',serialize(array('ประเภทบัญชี','ออมทรัพย์','กระแสรายวัน','บัญชีเงินฝากประจำ')));

define('COMMON_AREA_FEE_TYPE_TH',serialize(array('อัตราคงที่','แปรผันตามพื้นที่','อัตราส่วนกรรมสิทธิ์')));
define('COMMON_AREA_FEE_TYPE_EN',serialize(array('Static Rate','Dynamic Rate','Ownership Ratio')));

define('POST_PARCEL_TYPE_TH', serialize(array('ประเภทเอกสาร','จดหมายลงทะเบียน','พัสดุ','EMS')));
define('POST_PARCEL_TYPE_EN', serialize(array('Post or pacel type','Mail','Parcel','EMS')));

define('CF_RATE_RANGE_EN', serialize(array(
    36  => '3 Years',
    35  => '2 Years 11 Months',
    34  => '2 Years 10 Months',
    33  => '2 Years 9 Months',
    32  => '2 Years 8 Months',
    31  => '2 Years 7 Months',
    30  => '2 Years 6 Months',
    29  => '2 Years 5 Months',
    28  => '2 Years 4 Months',
    27  => '2 Years 3 Months',
    26  => '2 Years 2 Months',
    25  => '2 Years 1 Month',
    24  => '2 Years',
    23  => '1 Year 11 Months',
    22  => '1 Year 10 Months',
    21  => '1 Year 9 Months',
    20  => '1 Year 8 Months',
    19  => '1 Year 7 Months',
    18  => '1 Year 6 Months',
    17  => '1 Year 5 Months',
    16  => '1 Year 4 Months',
    15  => '1 Year 3 Months',
    14  => '1 Year 2 Months',
    13  => '1 Year 1 Month',
    12  => '1 Year',
    11  => '11 Months',
    10  => '10 Months',
    9   => '9 Months',
    8   => '8 Months',
    7   => '7 Months',
    6   => '6 Months',
    5   => '5 Months',
    4   => '4 Months',
    3   => '3 Months',
    2   => '2 Months',
    1   => '1 Month')));
define('CF_RATE_RANGE_TH', serialize(array(
    36  => '3 ปี',
    35  => '2 ปี 11 เดือน',
    34  => '2 ปี 10 เดือน',
    33  => '2 ปี 9 เดือน',
    32  => '2 ปี 8 เดือน',
    31  => '2 ปี 7 เดือน',
    30  => '2 ปี 6 เดือน',
    29  => '2 ปี 5 เดือน',
    28  => '2 ปี 4 เดือน',
    27  => '2 ปี 3 เดือน',
    26  => '2 ปี 2 เดือน',
    25  => '2 ปี 1 เดือน',
    24  => '2 ปี',
    23  => '1 ปี 11 เดือน',
    22  => '1 ปี 10 เดือน',
    21  => '1 ปี 9 เดือน',
    20  => '1 ปี 8 เดือน',
    19  => '1 ปี 7 เดือน',
    18  => '1 ปี 6 เดือน',
    17  => '1 ปี 5 เดือน',
    16  => '1 ปี 4 เดือน',
    15  => '1 ปี 3 เดือน',
    14  => '1 ปี 2 เดือน',
    13  => '1 ปี 1 เดือน',
    12  => '1 ปี',
    11  => '11 เดือน',
    10  => '10 เดือน',
    9   => '9 เดือน',
    8   => '8 เดือน',
    7   => '7 เดือน',
    6   => '6 เดือน',
    5   => '5 เดือน',
    4   => '4 เดือน',
    3   => '3 เดือน',
    2   => '2 เดือน',
    1   => '1 เดือน')));
define('NB_INVOICE','NBI'); // Invoice Table, key => invoice_no
define('NB_RECEIPT','NBR'); // Invoice Table, key => receipt_no
define('NB_EXPENSE','NBE'); // Invoice Table, key => expense_no
define('NB_PAYEE','NBP'); // Payee Table, key => payee_no
define('NB_WITHDRAWAL','NBW'); // Invoice Table, key => withdrawal_no
define('NB_PREPAID','NBS'); // property_unit_prepaid Table, key => pe_slip_no

define('KEY_CARD_STATUS_TH', serialize(array("0"=>'ปกติ', 1 =>'ระงับใช้งาน')));
define('KEY_CARD_STATUS_EN', serialize(array("0"=>'Active', 1 =>'InActive')));

define('PRINT_SETTING_TH', serialize(array(
    0=>'A4 มีลายน้ำ',
    1 =>'A4 ไม่มีลายน้ำ',
    2 =>'A5 ลายน้ำ',
    3 =>'A5 ไม่มีลายน้ำ',
    4 =>'กระดาษต่อเนื่องขนาด 9x5.5 นิ้ว',
    5 =>'กระดาษต่อเนื่องขนาด 9x11 นิ้ว'
)));
define('PRINT_SETTING_EN', serialize(array(
    0=>'A4, Watermark',
    1 =>'A4, No Watermark',
    2 =>'A5, Watermark',
    3 =>'A5, No Watermark',
    4 =>'Continuous Paper 9x5.5"',
    5 =>'Continuous Paper 9x11"'
)));

define('LEADS_SOURCE', serialize(array(
    1 => 'Facebook',
    2   => 'Google',
    3  => 'สื่อสิ่งพิมพ์',
    4  => 'ผู้แนะนำ',
    5   => 'อื่นๆ',
    6 => 'Line@',
    7 => 'E-mail',
)));
define('LEADS_TYPE', serialize(array(
    ''   =>'-กรุณาเลือกประเภท-',
    1 => 'นิติบุคคลจัดตั้งเอง',
    2   => 'บริษัทบริหารนิติบุคคล',
    3  => 'บริษัทพัฒนาอสังหา',
    4   => 'อื่นๆ',
)));
define('CONTRACT_TYPE', serialize(array(
    0 => '0',
    1   => '1',
    2  => '2',
    3   => '3',
)));
define('PAYMENT_TERM_TYPE', serialize(array(
    0 => 'เงินสด',
    1   => 'เงินโอน',
    2  => 'เช็ค'
)));
define('status_leads', serialize(array(
    ''   =>'-กรุณาเลือกสถานะ-',
    1   => 'ส่ง Demo ให้ลูกค้า',
    2   => 'ส่งรายละเอียดให้ลูกค้า',
    3   => 'ติดตามผลการทดลองใช้',
    4   => 'ตกลงใช้งานจริง',
    5   => 'ยกเลิกการทดลองใช้',
    6   => 'ไม่สนใจ'
)));
define('type_service', serialize(array(
    ''   =>'-กรุณาเลือกค่าบริการ-',
    1   => 'กรณีนี้ไม่มีการคิดค่าบริการในส่วนนี้',
    2   => 'กรณีนี้มีการคิดค่าบริการในส่วนนี้'
)));
