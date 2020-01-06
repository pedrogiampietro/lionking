<?PHP
if (!function_exists('is_https')) {
    function is_https()
    {
        if (!empty($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off') {
            return TRUE;
        } elseif (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && strtolower($_SERVER['HTTP_X_FORWARDED_PROTO']) === 'https') {
            return TRUE;
        } elseif (!empty($_SERVER['HTTP_FRONT_END_HTTPS']) && strtolower($_SERVER['HTTP_FRONT_END_HTTPS']) !== 'off') {
            return TRUE;
        }

        return FALSE;
    }
}

$is_https = is_https();

if ($is_https) {
    $base_url = "https://" . $_SERVER['HTTP_HOST'];
    $base_url .= str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
} else {
    $base_url = "http://" . $_SERVER['HTTP_HOST'];
    $base_url .= str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
}

/** SERVER URLS */
/** @var array $config */
$config['base_url'] = $base_url;
$config['site']['base_url'] = $base_url;
$config['site']['realurl'] = "https://sv2.warmen-ats.online/"; //Colocar a url real para seu website sem www
$config['site']['realurlwww'] = "https://sv2.warmen-ats.online/"; //Colocar a url real para seu website com www CASO SEJA UM SUBDOMINIO COLOCAR A MSM URL DA URL REAL
$config['site']['testurl'] = "http://localhost/"; // colocar a url que você utiliza para testar seu site (LOCALHOST)
/** END SERVER URLS */

/** SERVER PATHS */
if ($config['base_url'] == $config['site']['realurl'] || $config['base_url'] == $config['site']['realurlwww']) {
    $config['site']['serverPath'] = "/home/otserv/"; //SERVER PATH EM PRODUÇÃO
} elseif ($config['base_url'] == "https://localhost/warmen-website/") {
    $config['site']['serverPath'] = "H:\\Area de trabalho\\AstariServer\\"; //SERVERPATH LOCALHOST
} else {
    $config['site']['serverPath'] = "C:/otserv/"; //SERVERPATH LOCALHOST
}
/** END SERVER PATHS */

/** GOOGLE RECAPTCHA VALUES */
$config['site']['gRecaptchaSecret'] = "6LcaG8sUAAAAAFO84jCG3biOAh7UKRWkcpcLTSHa";
$config['site']['gRecaptchaSiteKey'] = "6LcaG8sUAAAAAEleKDbk7iltDXkBltpr9NDZCYII";

/** WIDGETS CONFIG */
$config['site']['widget_rank'] = TRUE;
$config['site']['widget_supportButton'] = false;
$config['site']['widget_buycharButton'] = false;
$config['site']['widget_PremiumBox'] = false;
$config['site']['widget_Serverinfobox'] = false;
$config['site']['widget_NetworksBox'] = false;
$config['site']['widget_CurrentPollBox'] = false;
$config['site']['widget_CastleWarBox'] = false;
$config['site']['widget_tibiaClips'] = TRUE;

/**
 * SISTEMA STREAM NA FIRST PAGE WITH MODAL OPEN WHEN CLICK
 * CONFIGS
 */

$config['site']['tibialcips_streamName'] = "lolgoiania";
$config['site']['tibialcips_modalTitle'] = "Stream do lolgoiania Online partiu acompanhar!";
$config['site']['tibialcips_modalSubtitle'] = "Sistema developado pelo Ricardin PHP. Ao vivo na stream só chora.";

/** WIDGETS 'widget_rank' TOP LVL CONFIGS */
$config['site']['top_lvl_qtd'] = 5; // 1 -- 5
$config['site']['top_lvl_group_inactive'] = '4,5,6'; // '1,2,3...'
$config['site']['top_lvl_acc_inactive'] = '1'; // '1,2,3...'
$config['site']['top_lvl_goku_isActive'] = TRUE; // TRUE - FALSE
$config['site']['top_lvl_out_anim'] = FALSE; // TRUE - FALSE

# Social Networks
$config['social']['status'] = TRUE;
$config['social']['facebook'] = "https://www.facebook.com/warmenonline/";
$config['social']['fbapiversion'] = "v3.2";
$config['social']['fbapilink'] = "https://graph.facebook.com/";
$config['social']['fbpageid'] = "101930253560373";
$config['social']['accessToken'] = "EAAJnmhgHVc0BAMBAGOB7HRfoZBarsdk0q1bljdls9ehZA9bZC2ZAlq0ZAtaNqpuJtpVZAWDLlgKUzmAsy7e0YMOoszivcPlJNpZCf9jC0z80wvThRzYUq6Pazr0ySLKLJmtLaXdJdRHZCS6Fd037DEn9Ls25C8qJt53cqgWCwsT0V63SZCrmdZB7FEStNOHn7t2iNVyB7DldGqaslDzQFiLWDE";
$config['social']['twitter'] = "@";
$config['social']['twittercreator'] = "Warmen";
$config['social']['fbappid'] = "101930253560373";

# Using Ajax Field Validation, this is important if you want to use ajax check in your create account.
$config['site']['sqlHost'] = "localhost";
$config['site']['sqlUser'] = "root";
$config['site']['sqlPass'] = "pedrorlx@94";
$config['site']['sqlBD'] = "otserv";

# Config Shop
$outfits_list = array();
$loyalty_title = array(
    50 => 'Scout',
    100 => 'Sentinel',
    200 => 'Steward',
    400 => 'Warden',
    1000 => 'Squire',
    2000 => 'Warrior',
    3000 => 'Keeper',
    4000 => 'Guardian',
    5000 => 'Sage
');

/** Shopping */
$config['shop']['newitemdays'] = 1;
$config['site']['shop_system'] = true;

$config['site']['item_images_url'] = 'images/items/';
$config['site']['item_images_extension'] = '.gif';
$config['site']['addons_images_url'] = 'images/addons/';
$config['site']['addons_images_extension'] = '.gif';
$config['site']['mounts_images_url'] = 'images/mounts/';
$config['site']['mounts_images_extension'] = '.gif';

# Character Former name, time in days to show the former names
$config['site']['formerNames'] = 10;
$config['site']['formerNames_amount'] = 10;

# PAGE: characters.php
$config['site']['quests'] = array(
    "Demon Helmet" => 70001,
    "In Service of Yalahar" => 70051,
    "Pits Of Inferno" => 70041,
    "Brotherhood Quest" => 70057,
    "The Annihilator" => 70003,
    "The Horror Quest" => 70055,
    "Ancients Quest" => 70014,
    "Elane Quest" => 70005,
    "Behemoth Quest" => 70048
);

# PAGE: whoisonline.php
$config['site']['private-servlist.com_server_id'] = 0;

# Account Maker Config
$config['site']['encryptionType'] = 'sha1';
$config['site']['useServerConfigCache'] = FALSE;
$towns_list = array(
    1 => 'Hadria',
    2 => 'Hawalla',
    3 => 'Ardor',
    4 => 'Disur',
    5 => 'Frizen',
	6 => 'Eximius',
);
$vocations_list = [
    15 => "No Vocation",
    0 => "No Vocation",
    1 => "Sorcerer",
    2 => "Druid",
    3 => "Paladin",
    4 => "Knight",
    5 => "Master Sorcerer",
    6 => "Elder Druid",
    7 => "Royal Paladin",
    8 => "Elite Knight",
    9 => "Masterful Sorcerer",
    10 => "Ancient Druid",
    11 => "Glorious Paladin",
    12 => "Rageful Knight",
    13 => "ALL"];
$highscores_list = [
//    1 => "Achievements",
    2 => "Axe Fighting",
    3 => "Club Fighting",
    4 => "Distance Fighting",
    5 => "Experience Points",
    6 => "Fishing",
    7 => "First Fighting",
//    8 => "Loyalty Points",
    9 => "Magic Level",
    10 => "Shielding",
    11 => "Sword Fighting"
];
# Create Account Options
$config['site']['one_email'] = TRUE;
$config['site']['create_account_verify_mail'] = FALSE;
$config['site']['verify_code'] = TRUE;
$config['site']['email_days_to_change'] = 3;
$config['site']['newaccount_premdays'] = 0;
$config['site']['send_register_email'] = TRUE;
$config['site']['flash_client_enabled'] = FALSE;

# Players Online
$config['site']['ip'] = 'sv2.Warmen-ATS.online';
$config['site']['statusPort'] = 7171;

############################
######     Events     ######
############################
$config['site']['event_count'] = array("Safe Zone" => array("Mon,Tue,Wed,Thu,Fri,Sat,Sun", "14:30"),
    "Battlefield Event" => array("Tue,Wed,Thu,Fri,Sat,Sun", "20:30"),
    "Zombie Event" => array("Tue,Wed,Thu,Fri,Sat,Sun", "18:00"),
    "Snowball Event" => array("Tue,Wed,Thu,Fri,Sat,Sun", "09:30"),
);

# Create Character Options
$config['site']['newchar_vocations'] = array(0 => 'Rook Sample');
//$config['site']['newchar_vocations'] = array(1 => 'Sorcerer Sample', 2 => 'Druid Sample', 3 => 'Paladin Sample', 4 => 'Knight Sample');
$config['site']['newchar_towns'] = array(1);
$config['site']['max_players_per_account'] = 7;

# Emails Config
$config['site']['lost_acc'] = true;
$config['site']['send_emails'] = true;
$config['site']['mail_address'] = "arksoftsite@gmail.com";
$config['site']['mail_senderName'] = "Ark Soft";
$config['site']['smtp_enabled'] = true;
$config['site']['smtp_host'] = "smtp.gmail.com"; // n?o coloque ssl aqui
$config['site']['smtp_port'] = 465; //587-tls | 465-ssl
$config['site']['smtp_auth'] = true;
$config['site']['smtp_user'] = "arksoftsite@gmail.com";
$config['site']['smtp_pass'] = "pedrorlx";
$config['site']['smtp_secure'] = 'ssl';

# PAGE: accountmanagement.php
$config['site']['send_mail_when_change_password'] = TRUE;
$config['site']['send_mail_when_generate_reckey'] = TRUE;
$config['site']['email_time_change'] = 7;
$config['site']['daystodelete'] = 7;

# PAGE: guilds.php
$config['site']['guild_need_level'] = 0;
$config['site']['guild_need_pacc'] = FALSE;
$config['site']['guild_image_size_kb'] = 50;
$config['site']['guild_description_chars_limit'] = 2000;
$config['site']['guild_description_lines_limit'] = 6;
$config['site']['guild_motd_chars_limit'] = 250;

# PAGE: adminpanel.php
$config['site']['access_admin_panel'] = 3;

# PAGE: latestnews.php
$config['site']['news_limit'] = 6;

# PAGE: killstatistics.php
$config['site']['last_deaths_limit'] = 40;

# PAGE: team.php
$config['site']['groups_support'] = array(2, 3, 4, 5);

# PAGE: highscores.php INACTIVE
$config['site']['groups_hidden'] = array(3, 4, 5, 6);
$config['site']['accounts_hidden'] = array(1);

# PAGE: lostaccount.php
$config['site']['email_lai_sec_interval'] = 180;

/** LANDPAGE CONFIG */
$config['site']['landpage_isactive'] = FALSE;
$config['site']['landpage_title'] = "";
$config['site']['landpage_timeout'] = 60 * 60; //Tempo em segundos 1*60 = 1 minuto
$config['site']['landpage_description'] = "You're welcome!"; //Escreva aqui um texto para aparecer na landpage
$config['site']['landpage_max_noticias'] = 10; //Numero máximo de noticias exibidas na landpage.
$config['site']['landpage_youtube'] = "CbIdEoz3RCs"; // id do video do youtube


/** OUIBOUNCE -- EXIBE UM MODAL AO TIRAR O MOUSE DA TELA*/
$config['site']['ouibounce_isActive'] = FALSE;


/** HIGH SCORES CONFIG */
$config['site']['h_limit'] = 25; //limite players por de pagina
$config['site']['h_limitOffset'] = 200; //Limita a quantidade maxima de players no rank
$config['site']['h_group_acc_show'] = "1,2,4,6"; //Seleciona os grupos de class que irão aparecer no rank

/** INFO_BAR TIBIA NEW LIKE */
$config['site']['info_bar_active'] = TRUE;
$config['site']['info_bar_cast'] = TRUE;
$config['site']['info_bar_twitch'] = FALSE;
$config['site']['info_bar_youtube'] = FALSE;
$config['site']['info_bar_forum'] = FALSE;
$config['site']['info_bar_online'] = TRUE;
$config['site']['info_bar_online_botton_table'] = false;

/**
 * DONATE CONFIG LIKE PAGASEGURO OLD_CONFIG
 * (50*10) = R$5,00 // 50 = TIBIA COINS COUNT Proporção de 1 pra 1
 */

$config['donate']['offers'] = [
    /** id =>[PRICE=>COINS]*/
    0 => [(5 * 100) => 5],
    1 => [(10 * 100) => 10],
    2 => [(15 * 100) => 15],
    3 => [(20 * 100) => 20],  //10% desconto
    4 => [(25 * 100) => 25], //20% desconto
    5 => [(30 * 100) => 30], //30% desconto
    6 => [(50 * 100) => 50], //40% desconto
    7 => [(100 * 100) => 100], //50% desconto
//    9 => [24500 => 5000]
];
$proporcao_preco = (array_keys($config['donate']['offers'][intval(0)])[0] / 100);
$proporcao_qnt = array_values($config['donate']['offers'][intval(0)])[0];

$config['donate']['proporcao'] = $proporcao_preco / $proporcao_qnt;
$config['donate']['show_proporcao'] = FALSE;

/**
 * configure your active payment method with this
 * TRUE = ACTIVE
 * FALSE = INACTIVE
 */
$config['paymentsMethods'] = [
    'pagseguro' => TRUE,
    'paypal' => TRUE,
    'mercadoPago' => FALSE,
    'transfer' => false,
    'picpay' => false
];

/** PICPAY CONFIGS */
$config['picpay']['user'] = 'Ricardo.codenome'; //Usuário sem o @

/** Bank transfer data */
$config['banktransfer'] = [
    0 => [
        'bank' => 'Itaú',
        'agency' => '7417',
        'account' => '42185-1',
        'name' => 'Ricardo Antônio Souza Filho',
        'operation' => 003,
        'email' => 'souzaariick@gmail.com',
        'acctype' => 'Conta Corrente'
    ],
    1 => [
        'bank' => 'BB',
        'agency' => '7417',
        'account' => '42185-1',
        'name' => 'Ricardo Antônio Souza Filho',
        'operation' => 003,
        'email' => 'souzaariick@gmail.com',
        'acctype' => 'Conta Corrente'
    ]
//    EXAMPLE TO ADD MORE
//    1 => [
//        'bank' => '',
//        'agency' => '',
//        'account' => '',
//        'name' => '',
//        'operation' => '',
//        'email' => '',
//        'acctype' => ''
//    ]
];

/** PAGSEGURO FIXED */
$config['pagseguro']['testing'] = false;
$config['pagseguro']['lightbox'] = TRUE;
$config['pagseguro']['tokentest'] = "8F6D588DEF924215BD84528233AD59A9";

/** PAGSEGURO CONFIGS */
$config['pagseguro']['email'] = "pedrin.rlx@hotmail.com";
$config['pagseguro']['token'] = "ed5705f6-74cf-43a6-bb31-afc25a91b7abe83d4b254ce09d5750e963e5bd7bf818d032-9928-4c4e-84f0-e135f272b609";
$config['pagseguro']['produtoNome'] = 'Tibia Coins';
$config['pagseguro']['urlRedirect'] = $config['base_url'];
$config['pagseguro']['urlNotification'] = $config['base_url'] . 'retpagseguro.php';
$config['pagseguro']['offers'] = [
    500 => 75,
    800 => 125,
    1500 => 250,
    2800 => 500,
    4900 => 1000
];

/** PayPal configs */
$config['paypal']['email'] = "souzaariick@gmail.com";
$config['paypal']['sandboxemail'] = "meuvendedor@gmail.com";
$config['paypal']['itemName'] = "Tibia Coins";
$config['paypal']['notify_url'] = $config['base_url'] . "paypal_ipn.php";
$config['paypal']['currency'] = "BRL";
/** SETUP LIVE OR TESTING YOUR IMPLEMENT */
$config['paypal']['env'] = "production"; // sandbox | production
/** PRODUCTION IDS */
$config['paypal']['clientID'] = 'AdnTdL0bwY_XiSq8IxWPaybRmW26O7YfijrZAu64TtcXdwwh-rpBErdPcukrZrmMOOr9exr8778k41ch';
$config['paypal']['clientSecretID'] = 'EN9G8CE2rL0pfp8uIe0kj0ywAEG-8IdFkotyUTY-MzPnzMMLM2a8uHSLjqxZ_Zl7ppQEW3tr4nW_bYUP';
/** SANDBOX IDS */
$config['paypal']['sandboxClientID'] = 'ATtqZDqzTFqrW8jmIGbI4xhhY5LORJDyQGxHrvrWOySbsqocOoki3PJsg-nipAiDX7MoR2VuMlTJslHH';
$config['paypal']['sandboxClientSecretID'] = 'EGBlw_5nm67PhYvnVFn7r9j8pQKAeW0jXIi1tpKDteZEl1zOiEexm0uh7fYOwv5Uou-CLN3zQkNHgtbW';
/** ##PayPal configs */

/** MERCADO PAGO CONFIGS */
$config['mp']['CLIENT_ID'] = "8086599824441987";
$config['mp']['CLIENT_SECRET'] = "QkM8W4XKVxf44bwQFsGPEI8NP8oXN0H0";
$config['mp']['SANDBOX_CLIENT_ID'] = "561209321300263";
$config['mp']['SANDBOX_CLIENT_SECRET'] = "TyBDJkckJxS2MhqHIzuu0p7SuE9xRnyc";
$config['mp']['sandboxMode'] = TRUE; // TRUE | FALSE
$config['sale']['productName'] = "Tibia Coins";
$config['sale']['subProductName'] = "Coins";
/** ##MERCADO PAGO CONFIGS */

/** LAYOUT CONFIGS */
$config['site']['layout'] = 'yinz'; //Layout Name
$config['site']['vdarkborder'] = '#505050';
$config['site']['darkborder'] = '#D4C0A1';
$config['site']['lightborder'] = '#F1E0C6';
$config['site']['download_page'] = FALSE;
$config['site']['serverinfo_page'] = TRUE;
$config['site']['cssVersion'] = "?vs=2.0.6";

/** MULTIPLE REQ CONFIGS */
$config['site']['max_req_tries'] = 3;
$config['site']['timeout_time'] = 1; //TIME IN MINUTES

/** MULTIPLE WEBSITE REQ CONFIGS */
$config['site']['website_max_req_tries'] = 140;
$config['site']['website_timeout_time'] = 3; //TIME IN MINUTES

/** SELL CHARACTERS ACCOUNT CONFIGURE */
$config['sell']['account_seller_id'] = 2;
$config['site']['max_price_coin'] = 10000;
$config['site']['max_price_gold'] = 100000000;
$config['site']['sell_by_gold'] = FALSE;
$config['site']['min_lvl_to_sell'] = 1;
/** SALE TAXES PERCENT 0-100 */
$config['site']['percent_sellchar_sale'] = 5;

/** Promoção configuration */
$config['site']['promo_isactive'] = FALSE;
$config['site']['promo_imagename'] = 'promo.png';
$config['site']['websitelogo'] = "tibia-logo-artwork-top-codenome-website.png";

/** website sale */
$config['site']['website_sale'] = false;

/** DISCORD WIDGET */
$config['site']['discord_widget_id'] = '580687700508672000';

/** Promoção valor x => multiplicador */
$config['site']['promoactive'] = true;
$config['site']['promovalues'] = [
    /**valor => Multiplicador*/
    30 => 2,
    100 => 3
];

/** SELL CHARACTERS VARIABLES LOAD */
$config['site']['Outfits_path'] = $config['site']['serverPath'] . "data/XML/outfits.xml";
$config['site']['Mounts_path'] = $config['site']['serverPath'] . "data/XML/mounts.xml";
$config['site']['Itens_path'] = $config['site']['serverPath'] . "data/items/items.xml";
$config['site']['Events_path'] = $config['site']['serverPath'] . "data/globalevents/globalevents.xml";
$config['site']['Quests_path'] = $config['site']['serverPath'] . "data/XML/quests.xml";