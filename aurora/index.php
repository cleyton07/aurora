<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aurora Viagens | Sua Melhor Experiência de Viagem</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <!-- Header -->
    <header>
        <nav class="navbar">
            <div class="logo">
                <i class="fas fa-plane"></i>
                <span>Aurora Viagens</span>
            </div>
            <ul class="nav-links">
                <li><a href="#">Home</a></li>
                <li><a href="../aurora/pacotes.html">Destinos</a></li>
                <li><a href="../contato.php">Contato</a></li>
                <li><a href="../aurora/ia.html">AuroraAssist</a></li>
                <li><a href="../turismo_page.php">Guia do Interior</a></li>
            </ul>
        
           
            <?php
session_start();
if (isset($_SESSION['logado']) && $_SESSION['logado'] === true): ?>
    <!-- Usuário logado -->
    <div class="user-menu">
        <div class="user-info">
            <i class="fas fa-user-circle"></i>
            <span>Olá, <?php echo $_SESSION['usuario_nome']; ?></span>
            <div class="dropdown">
                <a href="../perfil.php"><i class="fas fa-user"></i> Meu Perfil</a>
                <a href="../minhas-viagens.php"><i class="fas fa-suitcase"></i> Minhas Viagens</a>
                <a href="../logout.php" onclick="return sairPerfilSimples()">
                    <i class="fas fa-sign-out-alt"></i> Sair
                </a>
            </div>
        </div>
    </div>
<?php else: ?>
    <!-- Usuário não logado -->
    <div class="auth-buttons">
        <a href="../login.php" class="btn-login">Login</a>
        <a href="../cadastro.php" class="btn-register">Cadastrar</a>
    </div>
<?php endif; ?>
        
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1>Descubra o interior com a Aurora Viagens</h1>
            <p>Experiências exclusivas, pacotes personalizados e aventuras inesquecíveis.</p>
        </div>
    </section>

   <!-- Destaques -->
   <section class="featured">
    <h2 class="section-title">Destinos em Destaque</h2>
    <div class="destinations">
        <div class="destination-card">
            <div class="card-img">
                <img src="https://static1.carrocao.com/Fotos/2017/06/20170605359483/fm3sqr8x.jpg" >
            </div>
            <div class="card-content">
                <h3>Sitio Do Carroção Tatui,sp</h3>
                <p>Paraíso tropical com praias de águas cristalinas e natureza preservada.</p>
                <p class="price"></p>
                <a href="../aurora/cidades/tatui.html" class="btn">Saiba mais</a>

            </div>
        </div>
        <div class="destination-card">
            <div class="card-img">
                <img src="https://agendasorocaba.com.br/wp-content/uploads/2024/06/campeonato-brasileiro-de-balonismo-em-boituva.jpg">
            </div>
            <div class="card-content">
                <h3>Balonismo, Boituva, sp</h3>
                <p>A cidade luz, romântica e cheia de cultura e história.</p>
                <p class="price"></p>
                <a href="../aurora/cidades/boituva.html" class="btn">Saiba mais</a>

            </div>
        </div>
        <div class="destination-card">
            <div class="card-img">
                <img src="https://www.adibra.com.br/Content/upload/photos/2099/castelo-park-aquatico-lago-do-tubarao-foto-por-divulgacao-castelo-park-aquatico.jpg">
            </div>
            <div class="card-content">
                <h3>Parque aquatico, Cesario lange</h3>
                <p>A cidade que nunca dorme, cheia de energia e atrações incríveis.</p>
                <p class="price"></p>
                <a href="../aurora/cidades/cesariolange.html" class="btn">Saiba mais</a>

            </div>
        </div>
    </div>
</section>

<!-- Ofertas Especiais -->
<section class="offers">
    <h2 class="section-title">Cidades incríveis</h2>
    <p>Conheça nosso interior e planeje sua próxima aventura!</p>
    <a href="../aurora/pacotes.html" class="btn" style="background-color: var(--secondary); margin-top: 2rem;">
        Conheça as Cidades
    </a>
    
</section>

    
    <section class="about-us">
        <div class="about-container">
            <div class="about-text animate">
                <h2>Sobre Nós</h2>
                <p>
                Na Aurora Viagens, buscamos transformar cada viagem em uma experiência única e inesquecível. Selecionamos com cuidado cada destino e pacote, garantindo conforto, aventura e momentos que ficarão para sempre na sua memória.

Com atendimento personalizado, suporte dedicado e ofertas exclusivas, ajudamos você a planejar a viagem dos seus sonhos de maneira prática, segura e sem complicações.
                </p>
                <button class="btn btn-about">Saiba Mais <i class="fas fa-arrow-right"></i></button>
            </div>
            <div class="about-image animate">
                <img src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/1b/e2/52/69/hotel-sitio-do-carrocao.jpg" alt="Sobre Aurora Viagens">
            </div>
        </div>
    </section>
    

   
    <!-- Footer -->
    <footer>
        <div class="footer-links">
            <a href="#">Sobre Nós</a>
            <a href="#">Termos de Uso</a>
            <a href="#">Política de Privacidade</a>
            <a href="#">FAQ</a>
            <a href="#">Contato</a>
        </div>
        <div class="social-icons">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-linkedin-in"></i></a>
        </div>
        <p class="copyright">© 2025 Aurora Viagens. Todos os direitos reservados.</p>
    </footer>

    <script>
        const hamburger = document.querySelector(".hamburger");
        const navLinks = document.querySelector(".nav-links");

        hamburger.addEventListener("click", () => {
            navLinks.classList.toggle("open");
        });


        
const aboutImg = document.querySelector(".about-image img");

window.addEventListener("scroll", () => {
    const offset = window.pageYOffset;
    aboutImg.style.transform = `translateY(${offset * 0.05}px) scale(1.05)`;
});



<script>
<script>
function sairPerfil() {
    if (confirm('Tem certeza que deseja sair da sua conta?')) {
        // Mostrar loading ou feedback visual
        const userInfo = document.querySelector('.user-info');
        if (userInfo) {
            userInfo.style.opacity = '0.7';
            userInfo.innerHTML = '<i class="fas fa-spinner fa-spin"></i><span>Saindo...</span>';
        }
        
        // Fazer logout via AJAX
        fetch('../logout_ajax.php')
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Redirecionar para a mesma página (index) sem sessão
                    window.location.href = data.redirect || '../aurora/index.php';
                } else {
                    alert('Erro ao fazer logout');
                    window.location.reload();
                }
            })
            .catch(error => {
                console.error('Erro:', error);
                // Fallback: redirecionar para logout normal
                window.location.href = '../logout.php';
            });
    }
}

// Versão mais simples (recomendada)
function sairPerfilSimples() {
    if (confirm('Tem certeza que deseja sair da sua conta?')) {
        window.location.href = '../logout.php';
    }
    return false;
}
</script>

</script>

    </script>
</body>
</html>



    