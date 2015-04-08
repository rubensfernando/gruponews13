<?php
//Funcoes Especificas do Template GrupoNews10

$hoje_data = date('d/m/Y');

$hoje_hora = date('H:i');

$post_linkPDF = get_post_meta($post -> ID, 'post_linkPDF', true);

$video_imagem = get_post_meta($post -> ID, 'video_imagem', true);

$video_player = get_post_meta($post -> ID, 'video_player', true);

$audio_caminho = get_post_meta($post -> ID, 'audio_caminho', true);

$audio_download = get_post_meta($post -> ID, 'audio_download', true);

$jornal_capa = get_post_meta($post -> ID, 'jornal_capa', true);

$jornal_linkPDF = get_post_meta($post -> ID, 'jornal_linkPDF', true);

$publicacoes_capa = get_post_meta($post -> ID, 'publicacoes_capa', true);

$velho_post_image = get_post_meta($post -> ID, 'post_imagem', true);
$novo_post_image = get_post_meta($post -> ID, 'wpcf-gn_post_imagem', true);

$velho_post_autor = get_post_meta($post -> ID, 'post_autor', true);
$novo_post_autor = get_post_meta($post -> ID, 'wpcf-gn_post_autor', true);

if ($novo_post_imagem != "") {
	$post_image = $novo_post_image;
} else {
	$post_image = $velho_post_image;
}

if ($novo_post_autor != "") {
	$post_autor = $novo_post_autor;
} else {
	$post_autor = $velho_post_autor;
}

$webtv_palestra = types_render_field("gn_webtv_nome_palestra", array("raw" => "TRUE"));
$webtv_palestrante = types_render_field("gn_webtv_palestrante", array("raw" => "TRUE"));
$webtv_sistema = types_render_field("gn_webtv_sistema", array("raw" => "TRUE"));
$webtv_qualidade = types_render_field("gn_webtv_qualidade", array("raw" => "TRUE"));
?>