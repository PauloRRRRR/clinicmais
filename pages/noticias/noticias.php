<?php 

$title_page = "Notícias | ";
include dirname(__FILE__). '/../includes/header.php'; ?>
<link rel="stylesheet" href="../assets/css/noticias.css">

<main class="main mb-0" data-animate="top" data-delay="3">

<style>
        h1{
            color: #fff;
            padding: 10px 35px;
            background: linear-gradient(to right, #081a5e 0%, #355cc6 100%);
            display: inline-block;
            border-radius: 10px;
            width: 100%;
            max-width: 540px;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
        }
        #noticias-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }
        .noticia {
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 250px; /* Largura fixa para o quadrado */
            transition: transform 0.2s;
        }
        .noticia:hover {
            transform: scale(1.05); /* Efeito de aumento ao passar o mouse */
        }
        .noticia img {
            width: 100%; /* Imagem ocupa toda a largura do quadrado */
            height: auto;
            max-height: 150px; /* Altura máxima para manter as imagens menores */
            object-fit: cover; /* Corta a imagem para caber no quadrado */
        }
        .noticia h2 {
            font-size: 16px; /* Tamanho do título */
            margin: 10px 5px; /* Margem do título */
        }
        .noticia p {
            font-size: 14px; /* Tamanho do texto do conteúdo */
            margin: 5px 5px; /* Margem do texto */
            line-height: 1.4; /* Espaçamento entre linhas */
            max-height: 60px; /* Limita a altura do texto */
            overflow: hidden; /* Esconde o texto que ultrapassa a altura */
            text-overflow: ellipsis; /* Adiciona reticências se o texto for muito longo */
        }
        .noticia a {
            color: #007BFF; /* Cor do link */
            text-decoration: none; /* Remove o sublinhado */
        }
        .noticia a:hover {
            text-decoration: underline; /* Sublinha o link ao passar o mouse */
        }
    </style>
	 
<header class="page-header">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<h1>
					<span>Últimas Notícias</span>
				</h1>
			</div>
		</div>
	</div>
</header>

<section class="mb-4">
	<div class="container">
		<div class="row" id="noticias-container">
			<!-- As notícias serão carregadas aqui -->
		</div> <!-- row -->
	</div> <!-- container -->
</section>

<aside>
<?php
	$banner = rand(1,6);
?>
	<a href="<?=$config['whatsapp'];?>" target="_blank">
		<img src="assets/img/banner/0<?=$banner;?>.png" class="d-none d-md-block w-100">
		<img src="assets/img/banner/mobile0<?=$banner;?>.jpg" class="d-block d-md-none w-100">
	</a>
</aside>

</main>

<script>
fetch('https://newsdata.io/api/1/news?apikey=pub_56756287625925ad36b0e82c015debaf9d338&q=tech')
        .then(response => response.json())
        .then(data => {
            const container = document.getElementById('noticias-container');
            
            if (data.status === "success" && data.totalResults > 0) {
                data.results.forEach(noticia => {
                    const noticiaElement = document.createElement('div');
                    noticiaElement.className = 'noticia';
                    noticiaElement.innerHTML = `
                        <img src="${noticia.image_url || ''}" alt="${noticia.title}">
                        <h2><a href="${noticia.link}" target="_blank">${noticia.title}</a></h2>
                        <p>${noticia.description || 'Descrição não disponível.'}</p>
                        <p><strong>Autor:</strong> ${noticia.creator ? noticia.creator.join(', ') : 'Desconhecido'}</p>
                        <p><em>Publicado em: ${new Date(noticia.pubDate).toLocaleString('pt-BR')}</em></p>
                    `;
                    container.appendChild(noticiaElement);
                });
            } else {
                container.innerHTML = `<p>Nenhuma notícia disponível no momento.</p>`;
            }
        })
        .catch(error => {
            console.error('Erro ao buscar notícias:', error);
            document.getElementById('noticias-container').innerHTML = '<p>Erro ao carregar notícias.</p>';
        });
</script>

<?php 

include dirname(__FILE__). '/../includes/footer.php';

?>

