<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aurora Viagens - Descubra o Mundo Conosco</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #6a0dad;
            --primary-dark: #4b0082;
            --primary-light: #8a2be2;
            --secondary-color: #121212;
            --accent-color: #e6e6fa;
            --text-light: #f5f5f5;
            --text-dark: #333333;
            --card-bg: #1a1a1a;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: var(--secondary-color);
            color: var(--text-light);
            line-height: 1.6;
        }
        
        /* Header Styles */
        header {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            padding: 1rem 2rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .logo i {
            font-size: 2rem;
        }
        
        .logo h1 {
            font-size: 1.8rem;
            font-weight: 700;
        }
        
        .nav-links {
            display: flex;
            gap: 2rem;
        }
        
        .nav-links a {
            color: var(--text-light);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            padding: 0.5rem 1rem;
            border-radius: 4px;
        }
        
        .nav-links a:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }
        
        .search-bar {
            display: flex;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 30px;
            padding: 0.5rem 1rem;
            width: 300px;
        }
        
        .search-bar input {
            background: transparent;
            border: none;
            color: var(--text-light);
            width: 100%;
            padding: 0.5rem;
            outline: none;
        }
        
        .search-bar input::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }
        
        .search-bar button {
            background: transparent;
            border: none;
            color: var(--text-light);
            cursor: pointer;
        }
        
        /* Hero Section */
        .hero {
            height: 80vh;
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), 
                        url('https://static1.carrocao.com/Fotos/2018/01/20180129434517/4.jpg');
            background-size: cover;
            background-position: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 0 2rem;
        }
        
        .hero h2 {
            font-size: 3.5rem;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.5);
        }
        
        .hero p {
            font-size: 1.2rem;
            max-width: 700px;
            margin-bottom: 2rem;
        }
        
        .cta-button {
            background: linear-gradient(to right, var(--primary-color), var(--primary-light));
            color: white;
            border: none;
            padding: 1rem 2rem;
            font-size: 1.1rem;
            border-radius: 30px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 600;
            box-shadow: 0 4px 15px rgba(106, 13, 173, 0.4);
        }
        
        .cta-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(106, 13, 173, 0.6);
        }
        
        /* Categories Section */
        .categories {
            padding: 4rem 2rem;
            text-align: center;
        }
        
        .section-title {
            font-size: 2.5rem;
            margin-bottom: 3rem;
            position: relative;
            display: inline-block;
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 4px;
            background: linear-gradient(to right, var(--primary-color), var(--primary-light));
            border-radius: 2px;
        }
        
        .category-cards {
            display: flex;
            justify-content: center;
            gap: 2rem;
            flex-wrap: wrap;
        }
        
        .category-card {
            background-color: var(--card-bg);
            border-radius: 12px;
            padding: 2rem;
            width: 300px;
            text-align: center;
            transition: all 0.3s ease;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
        }
        
        .category-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 12px 25px rgba(106, 13, 173, 0.3);
        }
        
        .category-icon {
            font-size: 3rem;
            margin-bottom: 1.5rem;
            color: var(--primary-light);
        }
        
        .category-card h3 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }
        
        .category-card p {
            color: #aaa;
            margin-bottom: 1.5rem;
        }
        
        .category-link {
            color: var(--primary-light);
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }
        
        /* Featured Destinations */
        .featured {
            padding: 4rem 2rem;
            background-color: #0f0f0f;
        }
        
        .destination-cards {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }
        
        .destination-card {
            background-color: var(--card-bg);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }
        
        .destination-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 25px rgba(106, 13, 173, 0.3);
        }
        
        .card-image {
            height: 200px;
            overflow: hidden;
        }
        
        .card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        
        .destination-card:hover .card-image img {
            transform: scale(1.1);
        }
        
        .card-content {
            padding: 1.5rem;
        }
        
        .card-content h3 {
            font-size: 1.3rem;
            margin-bottom: 0.5rem;
        }
        
        .card-content p {
            color: #aaa;
            margin-bottom: 1rem;
            font-size: 0.9rem;
        }
        
        .card-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 1rem;
        }
        
        .rating {
            color: gold;
        }
        
        .view-details {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 500;
            transition: background-color 0.3s ease;
        }
        
        .view-details:hover {
            background-color: var(--primary-dark);
        }

        .location-type {
            display: inline-block;
            padding: 0.3rem 0.8rem;
            background: var(--primary-dark);
            border-radius: 20px;
            font-size: 0.8rem;
            margin-bottom: 0.5rem;
        }
        
        /* Loading Spinner */
        .loading {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem;
        }
        
        .spinner {
            width: 40px;
            height: 40px;
            border: 4px solid rgba(106, 13, 173, 0.3);
            border-left: 4px solid var(--primary-light);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        /* Footer */
        footer {
            background-color: #0a0a0a;
            padding: 3rem 2rem 1rem;
        }
        
        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }
        
        .footer-column h3 {
            font-size: 1.3rem;
            margin-bottom: 1.5rem;
            position: relative;
            padding-bottom: 0.5rem;
        }
        
        .footer-column h3::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 3px;
            background: linear-gradient(to right, var(--primary-color), var(--primary-light));
        }
        
        .footer-links {
            list-style: none;
        }
        
        .footer-links li {
            margin-bottom: 0.8rem;
        }
        
        .footer-links a {
            color: #aaa;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        
        .footer-links a:hover {
            color: var(--primary-light);
        }
        
        .social-icons {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
        }
        
        .social-icons a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background-color: var(--card-bg);
            border-radius: 50%;
            color: var(--text-light);
            transition: all 0.3s ease;
        }
        
        .social-icons a:hover {
            background-color: var(--primary-color);
            transform: translateY(-3px);
        }
        
        .copyright {
            text-align: center;
            padding-top: 2rem;
            border-top: 1px solid #333;
            color: #777;
            font-size: 0.9rem;
        }
        
        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            z-index: 2000;
            overflow-y: auto;
        }
        
        .modal-content {
            background-color: var(--card-bg);
            margin: 2rem auto;
            width: 90%;
            max-width: 1000px;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        }
        
        .modal-header {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            padding: 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .modal-header h2 {
            font-size: 1.8rem;
        }
        
        .close-modal {
            background: none;
            border: none;
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
        }
        
        .modal-body {
            padding: 2rem;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
        }
        
        .location-image {
            border-radius: 8px;
            overflow: hidden;
            height: 300px;
        }
        
        .location-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .location-details h3 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: var(--primary-light);
        }
        
        .location-info {
            margin-bottom: 1.5rem;
        }
        
        .location-info p {
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .location-info i {
            color: var(--primary-light);
            width: 20px;
        }
        
        .location-map {
            grid-column: 1 / -1;
            height: 300px;
            background-color: #333;
            border-radius: 8px;
            overflow: hidden;
            margin-top: 1rem;
        }
        
        /* Responsive Design */
        @media (max-width: 992px) {
            .modal-body {
                grid-template-columns: 1fr;
            }
            
            .navbar {
                flex-direction: column;
                gap: 1rem;
            }
            
            .search-bar {
                width: 100%;
                max-width: 400px;
            }
        }
        
        @media (max-width: 768px) {
            .hero h2 {
                font-size: 2.5rem;
            }
            
            .nav-links {
                flex-wrap: wrap;
                justify-content: center;
            }
            
            .section-title {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <nav class="navbar">
            <div class="logo">
                <i class="fas fa-compass"></i>
                <h1>Aurora Viagens</h1>
            </div>
            
            <div class="nav-links">
                <a href="#home">Início</a>
                <a href="#destinations">Destinos</a>
                <a href="#hotels">Hotéis</a>
                <a href="#restaurants">Restaurantes</a>
                <a href="#about">Sobre Nós</a>
            </div>
            
            <div class="search-bar">
                <input type="text" id="searchInput" placeholder="Pesquisar cidade...">
                <button id="searchButton"><i class="fas fa-search"></i></button>
            </div>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="hero" id="home">
        <h2>Descubra o Interior de São Paulo Conosco</h2>
        <p>Explore os melhores destinos, hotéis e restaurantes com a Aurora Viagens. Sua próxima aventura começa aqui.</p>
        <button class="cta-button">Explorar Destinos</button>
    </section>

    <!-- Categories Section -->
    <section class="categories">
        <h2 class="section-title">Nossos Serviços</h2>
        <div class="category-cards">
            <div class="category-card">
                <div class="category-icon">
                    <i class="fas fa-hotel"></i>
                </div>
                <h3>Hotéis</h3>
                <p>Encontre os melhores hotéis com conforto e qualidade para sua estadia.</p>
                <a href="#" class="category-link" data-filter="hoteis">Ver Hotéis <i class="fas fa-arrow-right"></i></a>
            </div>
            
            <div class="category-card">
                <div class="category-icon">
                    <i class="fas fa-utensils"></i>
                </div>
                <h3>Restaurantes</h3>
                <p>Descubra os restaurantes mais saborosos em cada destino.</p>
                <a href="#" class="category-link" data-filter="restaurantes">Ver Restaurantes <i class="fas fa-arrow-right"></i></a>
            </div>
            
            <div class="category-card">
                <div class="category-icon">
                    <i class="fas fa-map-marked-alt"></i>
                </div>
                <h3>Pontos Turísticos</h3>
                <p>Explore os lugares mais incríveis que cada cidade tem a oferecer.</p>
                <a href="#" class="category-link" data-filter="pontos_turisticos">Ver Pontos Turísticos <i class="fas fa-arrow-right"></i></a>
            </div>
        </div>
    </section>

    <!-- Featured Destinations -->
    <section class="featured" id="destinations">
        <h2 class="section-title">Destinos em Destaque</h2>
        
        <div class="loading" id="loading">
            <div class="spinner"></div>
        </div>
        
        <div class="destination-cards" id="destinationCards">
            <!-- Os cards serão carregados dinamicamente via JavaScript -->
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <div class="footer-column">
                <h3>Aurora Viagens</h3>
                <p>Sua agência de viagens de confiança, oferecendo as melhores experiências ao redor do mundo.</p>
                <div class="social-icons">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
            
            <div class="footer-column">
                <h3>Links Rápidos</h3>
                <ul class="footer-links">
                    <li><a href="#home">Início</a></li>
                    <li><a href="#destinations">Destinos</a></li>
                    <li><a href="#hotels">Hotéis</a></li>
                    <li><a href="#restaurants">Restaurantes</a></li>
                    <li><a href="#about">Sobre Nós</a></li>
                </ul>
            </div>
            
            <div class="footer-column">
                <h3>Contato</h3>
                <ul class="footer-links">
                    <!-- <li><i class="fas fa-map-marker-alt"></i> Av. Paulista, 1000 - São Paulo, SP</li>
                    <li><i class="fas fa-phone"></i> (11) 9999-9999</li> -->
                    <!-- <li><i class="fas fa-envelope"></i> contato@auroraviagens.com</li> -->
                </ul>
            </div>
        </div>
        
        <div class="copyright">
            <p>&copy; 2023 Aurora Viagens. Todos os direitos reservados.</p>
        </div>
    </footer>

    <!-- Modal for Location Details -->
    <div class="modal" id="locationModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 id="modalTitle">Detalhes do Local</h2>
                <button class="close-modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="location-image">
                    <img id="modalImage" src="" alt="Local Image">
                </div>
                <div class="location-details">
                    <h3 id="modalName">Nome do Local</h3>
                    <div class="location-info">
                        <p><i class="fas fa-map-marker-alt"></i> <span id="modalAddress">Endereço do local</span></p>
                        <p><i class="fas fa-phone"></i> <span id="modalPhone">Telefone do local</span></p>
                        <p><i class="fas fa-globe"></i> <span id="modalWebsite">Website do local</span></p>
                        <p><i class="fas fa-clock"></i> <span id="modalHours">Horário de funcionamento</span></p>
                        <p><i class="fas fa-tag"></i> <span id="modalType">Tipo de local</span></p>
                    </div>
                    <p id="modalDescription">Descrição detalhada do local.</p>
                </div>
                <div class="location-map">
                    <!-- Mapa seria implementado aqui com uma API como Google Maps -->
                    <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;background-color:#444;">
                        <p>Mapa do local seria exibido aqui</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Elementos do DOM
        const modal = document.getElementById('locationModal');
        const modalTitle = document.getElementById('modalTitle');
        const modalName = document.getElementById('modalName');
        const modalAddress = document.getElementById('modalAddress');
        const modalPhone = document.getElementById('modalPhone');
        const modalWebsite = document.getElementById('modalWebsite');
        const modalHours = document.getElementById('modalHours');
        const modalType = document.getElementById('modalType');
        const modalDescription = document.getElementById('modalDescription');
        const modalImage = document.getElementById('modalImage');
        const closeModal = document.querySelector('.close-modal');
        const searchInput = document.getElementById('searchInput');
        const searchButton = document.getElementById('searchButton');
        const destinationCards = document.getElementById('destinationCards');
        const loadingElement = document.getElementById('loading');
        const categoryLinks = document.querySelectorAll('.category-link');

        // Variáveis globais
        let allLocations = [];
        let currentFilter = 'all';

        // Função para carregar dados da API
        async function loadLocations(filter = 'all', cidade = '') {
            showLoading();
            
            try {
                const params = new URLSearchParams();
                if (filter !== 'all') params.append('tipo', filter);
                if (cidade) params.append('cidade', cidade);
                
                const response = await fetch(`api/get_locations.php?${params}`);
                const data = await response.json();
                
                if (data.status === 'success') {
                    allLocations = data.locations;
                    renderLocations(allLocations);
                } else {
                    throw new Error(data.message);
                }
            } catch (error) {
                console.error('Erro ao carregar locais:', error);
                destinationCards.innerHTML = `
                    <div style="grid-column: 1/-1; text-align: center; padding: 2rem;">
                        <p>Erro ao carregar os dados. Tente novamente mais tarde.</p>
                    </div>
                `;
            } finally {
                hideLoading();
            }
        }

        // Função para renderizar os locais
        function renderLocations(locations) {
            if (locations.length === 0) {
                destinationCards.innerHTML = `
                    <div style="grid-column: 1/-1; text-align: center; padding: 2rem;">
                        <p>Nenhum local encontrado para os critérios selecionados.</p>
                    </div>
                `;
                return;
            }

            destinationCards.innerHTML = locations.map(location => `
                <div class="destination-card" data-type="${location.type}" data-city="${location.city}">
                    <div class="card-image">
                        <img src="${location.image || 'https://images.unsplash.com/photo-1488646953014-85cb44e25828?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=60'}" 
                             alt="${location.name}" 
                             onerror="this.src='https://images.unsplash.com/photo-1488646953014-85cb44e25828?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=60'">
                    </div>
                    <div class="card-content">
                        <span class="location-type">${getTypeLabel(location.type)}</span>
                        <h3>${location.name}</h3>
                        <p>${location.description || 'Descrição não disponível.'}</p>
                        <div class="card-footer">
                            <div class="rating">
                                ${generateStars(location.rating || 4)}
                            </div>
                            <button class="view-details" 
                                    data-id="${location.id}" 
                                    data-type="${location.type}">
                                Ver Detalhes
                            </button>
                        </div>
                    </div>
                </div>
            `).join('');

            // Adicionar event listeners aos botões de detalhes
            document.querySelectorAll('.view-details').forEach(button => {
                button.addEventListener('click', function() {
                    const locationId = this.getAttribute('data-id');
                    const locationType = this.getAttribute('data-type');
                    showLocationDetails(locationId, locationType);
                });
            });
        }

        // Função para obter o label do tipo
        function getTypeLabel(type) {
            const types = {
                'hotel': 'Hotel',
                'restaurant': 'Restaurante',
                'attraction': 'Ponto Turístico'
            };
            return types[type] || 'Local';
        }

        // Função para gerar estrelas de avaliação
        function generateStars(rating) {
            const fullStars = Math.floor(rating);
            const hasHalfStar = rating % 1 !== 0;
            let stars = '';
            
            for (let i = 0; i < fullStars; i++) {
                stars += '<i class="fas fa-star"></i>';
            }
            
            if (hasHalfStar) {
                stars += '<i class="fas fa-star-half-alt"></i>';
            }
            
            const emptyStars = 5 - Math.ceil(rating);
            for (let i = 0; i < emptyStars; i++) {
                stars += '<i class="far fa-star"></i>';
            }
            
            return stars;
        }

        // Função para mostrar detalhes do local
        function showLocationDetails(locationId, locationType) {
            const location = allLocations.find(loc => 
                loc.id == locationId && loc.type === locationType
            );
            
            if (location) {
                modalTitle.textContent = `Detalhes - ${getTypeLabel(location.type)}`;
                modalName.textContent = location.name;
                modalAddress.textContent = location.address || 'Endereço não disponível';
                modalPhone.textContent = location.phone || 'Telefone não disponível';
                modalWebsite.textContent = location.website || 'Website não disponível';
                modalWebsite.href = location.website || '#';
                modalHours.textContent = location.hours || 'Horário não disponível';
                modalType.textContent = getTypeLabel(location.type);
                modalDescription.textContent = location.description || 'Descrição não disponível.';
                modalImage.src = location.image || 'https://images.unsplash.com/photo-1488646953014-85cb44e25828?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=60';
                modalImage.alt = location.name;
                
                modal.style.display = 'block';
            }
        }

        // Funções de loading
        function showLoading() {
            loadingElement.style.display = 'flex';
            destinationCards.style.display = 'none';
        }

        function hideLoading() {
            loadingElement.style.display = 'none';
            destinationCards.style.display = 'grid';
        }

        // Filtros por categoria
        categoryLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const filter = this.getAttribute('data-filter');
                currentFilter = filter;
                loadLocations(filter);
                
                // Scroll para a seção de destinos
                document.getElementById('destinations').scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        // Funcionalidade de busca
        searchButton.addEventListener('click', performSearch);
        searchInput.addEventListener('keyup', function(event) {
            if (event.key === 'Enter') {
                performSearch();
            }
        });

        function performSearch() {
            const searchTerm = searchInput.value.trim();
            if (searchTerm) {
                loadLocations(currentFilter, searchTerm);
            } else {
                loadLocations(currentFilter);
            }
        }

        // Fechar modal
        closeModal.addEventListener('click', function() {
            modal.style.display = 'none';
        });

        // Fechar modal ao clicar fora
        window.addEventListener('click', function(event) {
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        });

        // Carregar dados iniciais
        document.addEventListener('DOMContentLoaded', function() {
            loadLocations();
        });
    </script>
</body>
</html>