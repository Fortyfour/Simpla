<?php /*%%SmartyHeaderCode:17563926624ea1b3894b7250-16217739%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '11953e890561ba848ca8a18e58f696bace6fdd36' => 
    array (
      0 => 'simpla/design/html/page.tpl',
      1 => 1319220103,
      2 => 'file',
    ),
    '06f5a9e8f6314631c935e6c33c6d4bf26e63a269' => 
    array (
      0 => 'simpla/design/html/tinymce_init.tpl',
      1 => 1312802582,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17563926624ea1b3894b7250-16217739',
  'has_nocache_code' => false,
  'cache_lifetime' => '0',
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!$no_render) {?>
<script language="javascript" type="text/javascript" src="design/js/tiny_mce/plugins/smimage/smplugins.js"></script>
<script language="javascript" type="text/javascript" src="design/js/tiny_mce/tiny_mce.js"></script>
<script language="javascript">

  tinyMCE.init({
	// General options
	mode : "specific_textareas",
	editor_selector : /editor/,
	theme : "advanced",
	language : "ru",
	theme_advanced_path : false,
	apply_source_formatting : false,
	plugins : "jaretypograph,smimage,smexplorer,safari,spellchecker,style,table,save,advimage,advlink,inlinepopups,media,contextmenu,paste,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras",
	relative_urls : false,
	remove_script_host : true,
	convert_urls : true,
	verify_html: false,
    remove_linebreaks : false,
    content_css :"../design/default/css/style.css",
    spellchecker_languages : "+Russian=ru,+English=en",
            
	// Theme options
	theme_advanced_buttons1 : "save,newdocument,|,paste,pastetext,pasteword,|,undo,redo,|,bold,italic,underline,strikethrough,|,sub,sup,|,bullist,numlist,|,justifyleft,justifycenter,justifyright,justifyfull,|,forecolor,backcolor,|,styleselect,formatselect,fontselect,fontsizeselect",
	theme_advanced_buttons2 : "tablecontrols,|,link,unlink,anchor,smimage,smexplorer,charmap,nonbreaking,|,styleprops,attribs,|,jaretypograph,removeformat,cleanup,spellchecker,|,visualaid,fullscreen,code",
	theme_advanced_buttons3 : "",
	theme_advanced_buttons4 : "",
	theme_advanced_toolbar_location : "top",
	theme_advanced_toolbar_align : "left",
	theme_advanced_statusbar_location : "bottom",
	theme_advanced_resizing : true,

	file_browser_callback : "SMPlugins",
	plugin_smexplorer_directory : "/files/uploads",
	plugin_smimage_directory : "/files/uploads",
	
	setup : function(ed) {
		if(typeof set_meta == 'function')
		{
			ed.onKeyUp.add(set_meta);
			ed.onChange.add(set_meta);
		}
	}

	});

</script>
<script src="design/js/jquery/jquery.js"></script>
<script src="design/js/jquery/jquery-ui.min.js"></script>


<script>
$(function() {

	// Автозаполнение мета-тегов
	meta_title_touched = true;
	meta_keywords_touched = true;
	meta_description_touched = true;
	url_touched = true;
	
	if($('input[name="meta_title"]').val() == generate_meta_title() || $('input[name="meta_title"]').val() == '')
		meta_title_touched = false;
	if($('input[name="meta_keywords"]').val() == generate_meta_keywords() || $('input[name="meta_keywords"]').val() == '')
		meta_keywords_touched = false;
	if($('textarea[name="meta_description"]').val() == generate_meta_description() || $('textarea[name="meta_description"]').val() == '')
		meta_description_touched = false;
	if($('input[name="url"]').val() == generate_url())
		url_touched = false;
		
	$('input[name="meta_title"]').change(function() { meta_title_touched = true; });
	$('input[name="meta_keywords"]').change(function() { meta_keywords_touched = true; });
	$('textarea[name="meta_description"]').change(function() { meta_description_touched = true; });
	$('input[name="url"]').change(function() { url_touched = true; });
	
	$('input[name="name"]').keyup(function() { set_meta(); });
	$('select[name="brand_id"]').change(function() { set_meta(); });
	$('select[name="categories[]"]').change(function() { set_meta(); });
});

function set_meta()
{
	if(!meta_title_touched)
		$('input[name="meta_title"]').val(generate_meta_title());
	if(!meta_keywords_touched)
		$('input[name="meta_keywords"]').val(generate_meta_keywords());
	if(!meta_description_touched)
	{
		descr = $('textarea[name="meta_description"]');
		descr.val(generate_meta_description());
		descr.scrollTop(descr.outerHeight());
	}
	if(!url_touched)
		$('input[name="url"]').val(generate_url());
}

function generate_meta_title()
{
	name = $('input[name="name"]').val();
	return name;
}

function generate_meta_keywords()
{
	name = $('input[name="name"]').val();
	return name;
}

function generate_meta_description()
{
	if(typeof(tinyMCE.get("body")) =='object')
	{
		description = tinyMCE.get("body").getContent().replace(/(<([^>]+)>)/ig," ").replace(/(\&nbsp;)/ig," ").replace(/^\s+|\s+$/g, '').substr(0, 512);
		return description;
	}
	else
		return $('textarea[name=body]').val().replace(/(<([^>]+)>)/ig," ").replace(/(\&nbsp;)/ig," ").replace(/^\s+|\s+$/g, '').substr(0, 512);
}

function generate_url()
{
	url = $('input[name="name"]').val();
	url = url.replace(/[\s]+/gi, '_');
	url = translit(url);
	url = url.replace(/[^0-9a-z_]+/gi, '').toLowerCase();	
	return url;
}

function translit(str)
{
	var ru=("А-а-Б-б-В-в-Ґ-ґ-Г-г-Д-д-Е-е-Ё-ё-Є-є-Ж-ж-З-з-И-и-І-і-Ї-ї-Й-й-К-к-Л-л-М-м-Н-н-О-о-П-п-Р-р-С-с-Т-т-У-у-Ф-ф-Х-х-Ц-ц-Ч-ч-Ш-ш-Щ-щ-Ъ-ъ-Ы-ы-Ь-ь-Э-э-Ю-ю-Я-я").split("-")   
	var en=("A-a-B-b-V-v-G-g-G-g-D-d-E-e-E-e-E-e-ZH-zh-Z-z-I-i-I-i-I-i-J-j-K-k-L-l-M-m-N-n-O-o-P-p-R-r-S-s-T-t-U-u-F-f-H-h-TS-ts-CH-ch-SH-sh-SCH-sch-'-'-Y-y-'-'-E-e-YU-yu-YA-ya").split("-")   
 	var res = '';
	for(var i=0, l=str.length; i<l; i++)
	{ 
		var s = str.charAt(i), n = ru.indexOf(s); 
		if(n >= 0) { res += en[n]; } 
		else { res += s; } 
    } 
    return res;  
}


</script>





<!-- Системное сообщение -->
<div class="message message_success">
	<span>Страница обновлена</span>
	<a class="link" target="_blank" href="../oplata">Открыть страницу на сайте</a>
		<a class="button" href="/simpla/index.php?module=PagesAdmin">Вернуться</a>
	</div>
<!-- Системное сообщение (The End)-->




<!-- Основная форма -->
<form method=post id=product enctype="multipart/form-data">
	<input type=hidden name="session_id" value="2b7f56184c93c564e5463bf1f1aa06e7">
	<div id="name">
		<input class="name" name=name type="text" value="Оплата"/> 
		<input name=id type="hidden" value="2"/> 
		<div class="checkbox">
			<input name=visible value='1' type="checkbox" id="active_checkbox" checked/> <label for="active_checkbox">Активна</label>
		</div>
	</div> 

	<div id="product_categories">
		<select name="menu_id">
       		            	<option value='1' selected>Основное меню</option>
        	            	<option value='2' >Другие страницы</option>
        			</select>
	</div>

	<!-- Левая колонка свойств товара -->
	<div id="column_left">
			
		<!-- Параметры страницы -->
		<div class="block layer">
			<h2>Параметры страницы</h2>
			<ul>
				<li><label class=property>Адрес</label><div class="page_url">/</div><input name="url" class="page_url" type="text" value="oplata" /></li>
				<li><label class=property>Заголовок</label><input name="meta_title" class="simpla_inp" type="text" value="Оплата" /></li>
				<li><label class=property>Ключевые слова</label><input name="meta_keywords" class="simpla_inp" type="text" value="Оплата" /></li>
				<li><label class=property>Описание</label><textarea name="meta_description" class="simpla_inp"/>Оплата</textarea></li>
			</ul>
		</div>
		<!-- Параметры страницы (The End)-->
		

			
	</div>
	<!-- Левая колонка свойств товара (The End)--> 
		
	<!-- Описагние товара -->
	<div class="block layer">
		<h2>Текст страницы</h2>
		<textarea name="body"  class="editor_large">&lt;h2&gt;&lt;span&gt;Наличными курьеру&lt;/span&gt;&lt;/h2&gt;&lt;p&gt;Вы можете оплатить заказ курьеру в гривнах непосредственно в момент доставки. Курьерская доставка осуществляется по Москве на следующий день после принятия заказа.&lt;/p&gt;&lt;h2&gt;Webmoney&lt;/h2&gt;&lt;p&gt;После оформления заказа вы сможете перейти на сайт webmoney для оплаты заказа, где сможете оплатить заказ в автоматическом режиме, а так же проверить наш сертификат продавца.&lt;/p&gt;&lt;h2&gt;Наличными в офисе Автолюкса&lt;/h2&gt;&lt;p&gt;При доставке заказа системой Автолюкс, вы сможете оплатить заказ в их офисе непосредственно в момент получения товаров.&lt;/p&gt;</textarea>
	</div>
	<!-- Описание товара (The End)-->
	<input class="button_green button_save" type="submit" name="" value="Сохранить" />
	
</form>
<!-- Основная форма (The End) -->

<?php } ?>