<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Locais Cadastrados - Aurora Viagens</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
    :root {
        --primary-purple: #8B5CF6;
        --primary-dark: #7C3AED;
        --primary-darker: #6D28D9;
        --primary-light: #A78BFA;
        --primary-lighter: #C4B5FD;
        --black-bg: #0F0F0F;
        --dark-bg: #1A1A1A;
        --darker-bg: #141414;
        --card-bg: #242424;
        --card-border: #333333;
        --text-light: #F8FAFC;
        --text-muted: #94A3B8;
        --text-dark: #1E293B;
        --success: #10B981;
        --warning: #F59E0B;
        --danger: #EF4444;
        --gradient-primary: linear-gradient(135deg, var(--primary-purple) 0%, var(--primary-darker) 100%);
        --gradient-dark: linear-gradient(135deg, var(--dark-bg) 0%, var(--darker-bg) 100%);
        --gradient-card: linear-gradient(145deg, var(--card-bg) 0%, #2D2D2D 100%);
        --gradient-header: linear-gradient(135deg, var(--primary-dark) 0%, var(--black-bg) 100%);
        --shadow-glow: 0 0 30px rgba(139, 92, 246, 0.4);
        --shadow-card: 0 10px 30px rgba(0, 0, 0, 0.5);
        --shadow-hover: 0 20px 50px rgba(0, 0, 0, 0.7);
        --border-radius: 16px;
        --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    
    body {
        background: var(--gradient-dark);
        color: var(--text-light);
        font-family: 'Inter', sans-serif;
        line-height: 1.6;
        min-height: 100vh;
        overflow-x: hidden;
        position: relative;
    }
    
    body::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: 
            radial-gradient(circle at 20% 80%, rgba(139, 92, 246, 0.15) 0%, transparent 50%),
            radial-gradient(circle at 80% 20%, rgba(124, 58, 237, 0.1) 0%, transparent 50%),
            radial-gradient(circle at 40% 40%, rgba(99, 102, 241, 0.08) 0%, transparent 50%);
        z-index: -1;
    }
    
    /* Header Styles */
    header {
        background: var(--gradient-header);
        backdrop-filter: blur(20px);
        padding: 1rem 2rem;
        box-shadow: 0 4px 25px rgba(0, 0, 0, 0.4);
        position: sticky;
        top: 0;
        z-index: 1000;
        border-bottom: 1px solid rgba(139, 92, 246, 0.2);
    }
    
    .navbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        max-width: 1400px;
        margin: 0 auto;
    }
    
    .logo {
        display: flex;
        align-items: center;
        gap: 12px;
        transition: var(--transition);
    }
    
    .logo:hover {
        transform: translateY(-2px);
    }
    
    .logo-icon {
        width: 45px;
        height: 45px;
        background: var(--gradient-primary);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: var(--shadow-glow);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    .logo h1 {
        font-size: 1.9rem;
        font-weight: 800;
        background: linear-gradient(135deg, var(--primary-light) 0%, var(--primary-purple) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        text-shadow: 0 2px 15px rgba(139, 92, 246, 0.4);
        letter-spacing: -0.5px;
    }
    
    .nav-links {
        display: flex;
        gap: 1.5rem;
        align-items: center;
    }
    
    .nav-links a {
        color: var(--text-light);
        text-decoration: none;
        font-weight: 600;
        transition: var(--transition);
        padding: 0.6rem 1.2rem;
        border-radius: 10px;
        position: relative;
        overflow: hidden;
        font-size: 0.95rem;
    }
    
    .nav-links a::before {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 0;
        height: 2px;
        background: var(--gradient-primary);
        transition: var(--transition);
    }
    
    .nav-links a:hover::before {
        width: 100%;
    }
    
    .nav-links a.active {
        background: rgba(139, 92, 246, 0.15);
        color: var(--primary-light);
        box-shadow: 0 4px 15px rgba(139, 92, 246, 0.2);
    }
    
    .nav-links a.active::before {
        width: 100%;
    }
    
    .admin-actions {
        display: flex;
        gap: 1rem;
        align-items: center;
    }
    
    .btn {
        padding: 0.8rem 1.6rem;
        border-radius: 12px;
        font-weight: 600;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: var(--transition);
        border: none;
        cursor: pointer;
        font-size: 0.95rem;
        position: relative;
        overflow: hidden;
    }
    
    .btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
        transition: var(--transition);
    }
    
    .btn:hover::before {
        left: 100%;
    }
    
    .btn-primary {
        background: var(--gradient-primary);
        color: white;
        box-shadow: 0 4px 20px rgba(139, 92, 246, 0.5);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    .btn-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 30px rgba(139, 92, 246, 0.7), var(--shadow-glow);
    }
    
    .btn-secondary {
        background: rgba(255, 255, 255, 0.08);
        color: var(--text-light);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.15);
    }
    
    .btn-secondary:hover {
        background: rgba(255, 255, 255, 0.12);
        border-color: var(--primary-light);
        color: var(--primary-light);
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.4);
    }
    
    /* Hero Section */
    .page-hero {
        padding: 5rem 2rem 3rem;
        text-align: center;
        position: relative;
        overflow: hidden;
    }
    
    .hero-background {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: 
            radial-gradient(circle at 20% 80%, rgba(139, 92, 246, 0.2) 0%, transparent 50%),
            radial-gradient(circle at 80% 20%, rgba(124, 58, 237, 0.15) 0%, transparent 50%);
        z-index: -1;
    }
    
    .page-title {
        font-size: 3.8rem;
        font-weight: 800;
        margin-bottom: 1.2rem;
        background: linear-gradient(135deg, var(--primary-light) 0%, var(--primary-purple) 50%, var(--primary-darker) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        position: relative;
        display: inline-block;
        text-shadow: 0 4px 20px rgba(139, 92, 246, 0.3);
        letter-spacing: -1px;
    }
    
    .page-title::after {
        content: '';
        position: absolute;
        bottom: -15px;
        left: 50%;
        transform: translateX(-50%);
        width: 120px;
        height: 4px;
        background: var(--gradient-primary);
        border-radius: 2px;
        box-shadow: 0 2px 10px rgba(139, 92, 246, 0.5);
    }
    
    .page-subtitle {
        font-size: 1.3rem;
        max-width: 600px;
        margin: 2rem auto 3rem;
        color: var(--text-muted);
        font-weight: 400;
        line-height: 1.7;
    }
    
    /* Stats Section */
    .stats-section {
        padding: 0 2rem 3rem;
        max-width: 1200px;
        margin: 0 auto;
    }
    
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 1.8rem;
        margin-bottom: 2rem;
    }
    
    .stat-card {
        background: var(--gradient-card);
        padding: 2.2rem;
        border-radius: var(--border-radius);
        box-shadow: var(--shadow-card);
        text-align: center;
        transition: var(--transition);
        border: 1px solid var(--card-border);
        position: relative;
        overflow: hidden;
    }
    
    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.05), transparent);
        transition: var(--transition);
    }
    
    .stat-card:hover::before {
        left: 100%;
    }
    
    .stat-card:hover {
        transform: translateY(-8px);
        box-shadow: var(--shadow-hover), var(--shadow-glow);
        border-color: rgba(139, 92, 246, 0.3);
    }
    
    .stat-icon {
        width: 70px;
        height: 70px;
        background: var(--gradient-primary);
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.2rem;
        box-shadow: 0 8px 25px rgba(139, 92, 246, 0.4);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    .stat-number {
        font-size: 2.8rem;
        font-weight: 800;
        margin-bottom: 0.5rem;
        background: linear-gradient(135deg, var(--primary-light) 0%, var(--primary-purple) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        text-shadow: 0 2px 10px rgba(139, 92, 246, 0.3);
    }
    
    .stat-label {
        color: var(--text-muted);
        font-weight: 500;
        font-size: 0.95rem;
        letter-spacing: 0.5px;
    }
    
    /* Controls Section */
    .controls-section {
        padding: 2rem;
        max-width: 1200px;
        margin: 0 auto;
    }
    
    .controls-card {
        background: var(--gradient-card);
        padding: 2.2rem;
        border-radius: var(--border-radius);
        box-shadow: var(--shadow-card);
        border: 1px solid var(--card-border);
        position: relative;
        overflow: hidden;
    }
    
    .controls-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: var(--gradient-primary);
    }
    
    .controls-row {
        display: flex;
        gap: 1.8rem;
        align-items: center;
        flex-wrap: wrap;
    }
    
    .search-container {
        flex: 1;
        min-width: 320px;
        position: relative;
    }
    
    .search-input {
        width: 100%;
        padding: 1.1rem 1.1rem 1.1rem 3.2rem;
        background: rgba(30, 30, 30, 0.7);
        border: 1px solid #444;
        border-radius: 12px;
        color: var(--text-light);
        font-size: 1rem;
        transition: var(--transition);
        backdrop-filter: blur(10px);
        font-family: 'Inter', sans-serif;
    }
    
    .search-input:focus {
        outline: none;
        border-color: var(--primary-purple);
        background: rgba(40, 40, 40, 0.9);
        box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.2), 0 0 25px rgba(139, 92, 246, 0.1);
        transform: translateY(-2px);
    }
    
    .search-input::placeholder {
        color: var(--text-muted);
    }
    
    .search-icon {
        position: absolute;
        left: 1.2rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--primary-light);
        z-index: 2;
    }
    
    .filter-group {
        display: flex;
        gap: 1.2rem;
        flex-wrap: wrap;
    }
    
    .filter-select {
        padding: 1.1rem 1.5rem;
        background: rgba(30, 30, 30, 0.7);
        border: 1px solid #444;
        border-radius: 12px;
        color: var(--text-light);
        font-size: 0.95rem;
        backdrop-filter: blur(10px);
        transition: var(--transition);
        cursor: pointer;
        font-family: 'Inter', sans-serif;
    }
    
    .filter-select:focus {
        outline: none;
        border-color: var(--primary-purple);
        background: rgba(40, 40, 40, 0.9);
        box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.2);
        transform: translateY(-2px);
    }
    
    .filter-select option {
        background: var(--card-bg);
        color: var(--text-light);
        padding: 1rem;
    }
    
    .results-info {
        color: var(--text-muted);
        font-weight: 500;
        margin-top: 1.2rem;
        font-size: 0.95rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .results-info::before {
        content: '📊';
        font-size: 0.9rem;
    }
    
    /* Locations Grid */
    .locations-section {
        padding: 2rem;
        max-width: 1400px;
        margin: 0 auto;
    }
    
    .locations-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(380px, 1fr));
        gap: 2.2rem;
    }
    
    .location-card {
        background: var(--gradient-card);
        border-radius: var(--border-radius);
        overflow: hidden;
        box-shadow: var(--shadow-card);
        transition: var(--transition);
        border: 1px solid var(--card-border);
        position: relative;
        opacity: 0;
        transform: translateY(30px);
        animation: fadeInUp 0.6s ease forwards;
    }
    
    @keyframes fadeInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .location-card:hover {
        transform: translateY(-12px);
        box-shadow: var(--shadow-hover), var(--shadow-glow);
        border-color: rgba(139, 92, 246, 0.3);
    }
    
    .card-image {
        height: 240px;
        overflow: hidden;
        position: relative;
    }
    
    .card-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: var(--transition);
    }
    
    .location-card:hover .card-image img {
        transform: scale(1.15);
    }
    
    .card-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(to bottom, transparent 0%, rgba(0, 0, 0, 0.8) 100%);
        opacity: 0;
        transition: var(--transition);
        display: flex;
        align-items: flex-end;
        padding: 1.8rem;
    }
    
    .location-card:hover .card-overlay {
        opacity: 1;
    }
    
    .location-type {
        position: absolute;
        top: 1.2rem;
        right: 1.2rem;
        padding: 0.6rem 1.2rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.4);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    .type-hotel {
        background: linear-gradient(135deg, var(--primary-purple), var(--primary-darker));
    }
    
    .type-restaurante {
        background: linear-gradient(135deg, #EC4899, #BE185D);
    }
    
    .type-turismo {
        background: linear-gradient(135deg, #F59E0B, #D97706);
    }
    
    .type-agencia {
        background: linear-gradient(135deg, #8B5CF6, #7C3AED);
    }
    
    .card-content {
        padding: 1.8rem;
    }
    
    .card-content h3 {
        font-size: 1.5rem;
        margin-bottom: 0.8rem;
        color: var(--text-light);
        font-weight: 700;
        line-height: 1.3;
    }
    
    .card-content p {
        color: var(--text-muted);
        margin-bottom: 1.2rem;
        line-height: 1.6;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        font-size: 0.95rem;
    }
    
    .card-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 1.2rem;
        padding-top: 1.2rem;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        font-size: 0.85rem;
        color: var(--text-muted);
    }
    
    .card-meta span {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .card-actions {
        display: flex;
        gap: 0.8rem;
        margin-top: 1.8rem;
    }
    
    .btn-action {
        flex: 1;
        padding: 0.9rem 1.2rem;
        border-radius: 10px;
        font-weight: 600;
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        transition: var(--transition);
        font-size: 0.9rem;
        border: 1px solid transparent;
    }
    
    
    
    .btn-edit:hover {
        background: rgba(245, 158, 11, 0.2);
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(245, 158, 11, 0.3);
    }
    
    .btn-delete {
        background: rgba(239, 68, 68, 0.1);
        color: #EF4444;
        border-color: rgba(239, 68, 68, 0.2);
        cursor: pointer;
    }
    
    .btn-delete:hover {
        background: rgba(239, 68, 68, 0.2);
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3);
    }
    
    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 5rem 2rem;
        grid-column: 1 / -1;
        background: var(--gradient-card);
        border-radius: var(--border-radius);
        border: 1px solid var(--card-border);
        box-shadow: var(--shadow-card);
    }
    
    .empty-icon {
        width: 120px;
        height: 120px;
        background: rgba(139, 92, 246, 0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 2.5rem;
        font-size: 3rem;
        color: var(--primary-light);
        border: 2px solid rgba(139, 92, 246, 0.2);
    }
    
    .empty-state h3 {
        font-size: 2rem;
        margin-bottom: 1.2rem;
        color: var(--text-light);
        font-weight: 700;
        background: linear-gradient(135deg, var(--primary-light) 0%, var(--primary-purple) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    
    .empty-state p {
        color: var(--text-muted);
        max-width: 450px;
        margin: 0 auto 2.5rem;
        font-size: 1.1rem;
        line-height: 1.7;
    }
    
    /* Footer */
    footer {
        background: var(--gradient-header);
        padding: 4rem 2rem 2rem;
        margin-top: 5rem;
        border-top: 1px solid rgba(139, 92, 246, 0.2);
        position: relative;
    }
    
    .footer-content {
        max-width: 1200px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: 3.5rem;
        margin-bottom: 3rem;
    }
    
    .footer-column h3 {
        font-size: 1.4rem;
        margin-bottom: 1.8rem;
        position: relative;
        padding-bottom: 0.8rem;
        font-weight: 700;
        color: var(--text-light);
    }
    
    .footer-column h3::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 50px;
        height: 3px;
        background: var(--gradient-primary);
        border-radius: 2px;
    }
    
    .footer-links {
        list-style: none;
    }
    
    .footer-links li {
        margin-bottom: 1rem;
    }
    
    .footer-links a {
        color: var(--text-muted);
        text-decoration: none;
        transition: var(--transition);
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 0.95rem;
    }
    
    .footer-links a:hover {
        color: var(--primary-light);
        transform: translateX(8px);
    }
    
    .social-links {
        display: flex;
        gap: 1.2rem;
        margin-top: 2rem;
    }
    
    .social-link {
        width: 48px;
        height: 48px;
        background: rgba(255, 255, 255, 0.08);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--text-muted);
        text-decoration: none;
        transition: var(--transition);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    .social-link:hover {
        background: var(--gradient-primary);
        color: white;
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(139, 92, 246, 0.5);
    }
    
    .copyright {
        text-align: center;
        padding-top: 2.5rem;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        color: var(--text-muted);
        font-size: 0.9rem;
    }
    
    /* Responsive Design */
    @media (max-width: 1024px) {
        .navbar {
            flex-direction: column;
            gap: 1.8rem;
        }
        
        .nav-links {
            order: 3;
            width: 100%;
            justify-content: center;
            flex-wrap: wrap;
        }
        
        .admin-actions {
            order: 2;
        }
        
        .page-title {
            font-size: 3.2rem;
        }
    }
    
    @media (max-width: 768px) {
        .page-title {
            font-size: 2.8rem;
        }
        
        .locations-grid {
            grid-template-columns: 1fr;
        }
        
        .controls-row {
            flex-direction: column;
            align-items: stretch;
        }
        
        .search-container {
            min-width: auto;
        }
        
        .filter-group {
            width: 100%;
            justify-content: space-between;
        }
        
        .filter-select {
            flex: 1;
        }
        
        .stats-grid {
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        }
    }
    
    @media (max-width: 480px) {
        .page-hero {
            padding: 4rem 1rem 2rem;
        }
        
        .page-title {
            font-size: 2.2rem;
        }
        
        .locations-section {
            padding: 1rem;
        }
        
        .card-actions {
            flex-direction: column;
        }
        
        header {
            padding: 1rem;
        }
        
        .footer-content {
            grid-template-columns: 1fr;
            gap: 2.5rem;
        }
    }
    
    /* Scrollbar customizada */
    ::-webkit-scrollbar {
        width: 10px;
    }
    
    ::-webkit-scrollbar-track {
        background: var(--dark-bg);
    }
    
    ::-webkit-scrollbar-thumb {
        background: var(--gradient-primary);
        border-radius: 5px;
    }
    
    ::-webkit-scrollbar-thumb:hover {
        background: var(--primary-darker);
    }
</style>
</head>
<body>
    <!-- Header -->
    <header>
        <nav class="navbar">
            <div class="logo">
                <div class="logo-icon">
                    <i class="fas fa-compass"></i>
                </div>
                <h1>Aurora Viagens</h1>
            </div>
            
            <div class="nav-links">
                <a href="index.html">Início</a>
                <a href="listar.php" class="active">Locais</a>
                <a href="#destinations">Destinos</a>
                <a href="#hotels">Hotéis</a>
                <a href="#restaurants">Restaurantes</a>
            </div>
            
            
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="page-hero">
        <div class="hero-background"></div>
        <h1 class="page-title">Aurora Viagens</h1>
        <p class="page-subtitle">Turismo no interio de sp, melhores destinos, hoteis e restaurantes</p>
        
    </section>

    

    <!-- Controls Section -->
    <section class="controls-section">
        <div class="controls-card">
            <div class="controls-row">
                <div class="search-container">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" id="searchInput" class="search-input" placeholder="Pesquisar local...">
                </div>
                
                <div class="filter-group">
                    <select class="filter-select" id="typeFilter">
                        <option value="all">Todos os Tipos</option>
                        <option value="hotel">Hotéis</option>
                        <option value="restaurante">Restaurantes</option>
                        <option value="turismo">Pontos Turísticos</option>
                        <option value="agencia">Agências</option>
                    </select>
                    
                    <select class="filter-select" id="sortFilter">
                        <option value="newest">Mais Recentes</option>
                        <option value="oldest">Mais Antigos</option>
                        <option value="name">Ordenar por Nome</option>
                    </select>
                </div>
            </div>
            <div class="results-info">
                <span id="resultsCount">Carregando locais...</span>
            </div>
        </div>
    </section>

    <!-- Locations Grid -->
    <section class="locations-section">
        <div class="locations-grid" id="locationsGrid">
            <?php
            try {
                $stmt = $pdo->query("SELECT * FROM locais ORDER BY criado_em DESC");
                $locais = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                if (count($locais) > 0) {
                    $total = count($locais);
                    $hotels = 0;
                    $restaurants = 0;
                    $tourism = 0;
                    $agencies = 0;
                    
                    foreach ($locais as $index => $row) {
                        // Contar por tipo
                        if ($row['tipo'] == 'Hotel') $hotels++;
                        else if ($row['tipo'] == 'Restaurante') $restaurants++;
                        else if ($row['tipo'] == 'Turismo') $tourism++;
                        else if ($row['tipo'] == 'Agência') $agencies++;
                        
                        // Determinar a classe do tipo
                        $typeClass = 'type-hotel';
                        if ($row['tipo'] == 'Restaurante') $typeClass = 'type-restaurante';
                        else if ($row['tipo'] == 'Turismo') $typeClass = 'type-turismo';
                        else if ($row['tipo'] == 'Agência') $typeClass = 'type-agencia';
                        
                        echo '
                        <div class="location-card" data-type="'.strtolower($row['tipo']).'" style="animation-delay: '.($index * 0.1).'s">
                            <div class="card-image">
                                <img src="'.$row['imagem'].'" alt="'.$row['nome'].'" 
                                     onerror="this.src=\'https://images.unsplash.com/photo-1488646953014-85cb44e25828?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=60\'">
                                <div class="card-overlay"></div>
                                <span class="location-type '.$typeClass.'">'.$row['tipo'].'</span>
                            </div>
                            <div class="card-content">
                                <h3>'.$row['nome'].'</h3>
                                <p>'.$row['descricao'].'</p>
                                <div class="card-meta">
                                    <span><i class="far fa-calendar"></i> '.date('d/m/Y', strtotime($row['criado_em'])).'</span>
                                    <span><i class="fas fa-tag"></i> '.$row['tipo'].'</span>
                                </div>  
                                <div class="card-actions">
                                    <a href="editar.php?id='.$row['id'].'" class="btn-action btn-edit">
                                       
                                    </a>
                                   
                                </div>
                            </div>
                        </div>
                        ';
                    }
                    
                    // Atualizar estatísticas via JavaScript
                    echo '
                    <script>
                        document.getElementById("totalLocations").textContent = "'.$total.'";
                        document.getElementById("hotelsCount").textContent = "'.$hotels.'";
                        document.getElementById("restaurantsCount").textContent = "'.$restaurants.'";
                        document.getElementById("tourismCount").textContent = "'.$tourism.'";
                        document.getElementById("resultsCount").textContent = "'.$total.' locais encontrados";
                    </script>
                    ';
                } else {
                    echo '
                    <div class="empty-state">
                        <div class="empty-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <h3>Nenhum local cadastrado</h3>
                        <p>Comece adicionando o primeiro local ao seu catálogo de destinos.</p>
                        <a href="admin.php" class="btn btn-primary">
                            <i class="fas fa-plus-circle"></i> Adicionar Primeiro Local
                        </a>
                    </div>
                    ';
                    
                    echo '
                    <script>
                        document.getElementById("resultsCount").textContent = "Nenhum local encontrado";
                    </script>
                    ';
                }
            } catch (Exception $e) {
                echo '
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <h3>Erro ao carregar locais</h3>
                    <p>Ocorreu um erro ao tentar carregar os locais cadastrados. Tente novamente.</p>
                    <a href="admin.php" class="btn btn-primary">
                        <i class="fas fa-plus-circle"></i> Adicionar Local
                    </a>
                </div>
                ';
                
                echo '
                <script>
                    document.getElementById("resultsCount").textContent = "Erro ao carregar dados";
                </script>
                ';
            }
            ?>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <div class="footer-column">
                <h3>Aurora Viagens</h3>
                <p>Descubra os melhores destinos do interior de São Paulo com a gente. Sua próxima aventura começa aqui.</p>
                <div class="social-links">
                    <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
            
            <div class="footer-column">
                <h3>Navegação</h3>
                <ul class="footer-links">
                    <li><a href="index.html"><i class="fas fa-chevron-right"></i> Início</a></li>
                    <li><a href="listar.php"><i class="fas fa-chevron-right"></i> Locais Cadastrados</a></li>
                    <li><a href="#destinations"><i class="fas fa-chevron-right"></i> Destinos</a></li>
                    <li><a href="#hotels"><i class="fas fa-chevron-right"></i> Hotéis</a></li>
                    <li><a href="#restaurants"><i class="fas fa-chevron-right"></i> Restaurantes</a></li>
                </ul>
            </div>
            
            <div class="footer-column">
                <h3>Administração</h3>
                <ul class="footer-links">
                    <li><a href="admin.php"><i class="fas fa-chevron-right"></i> Adicionar Local</a></li>
                    <li><a href="dashboard.php"><i class="fas fa-chevron-right"></i> Dashboard</a></li>
                    <li><a href="#"><i class="fas fa-chevron-right"></i> Relatórios</a></li>
                    <li><a href="#"><i class="fas fa-chevron-right"></i> Configurações</a></li>
                </ul>
            </div>
        </div>
        
        <div class="copyright">
            <p>&copy; 2023 Aurora Viagens. Todos os direitos reservados. | Desenvolvido com <i class="fas fa-heart" style="color: #ef4444;"></i></p>
        </div>
    </footer>

    <script>
        // Elementos do DOM
        const searchInput = document.getElementById('searchInput');
        const typeFilter = document.getElementById('typeFilter');
        const sortFilter = document.getElementById('sortFilter');
        const locationsGrid = document.getElementById('locationsGrid');
        const resultsCount = document.getElementById('resultsCount');
        const locationCards = document.querySelectorAll('.location-card');
        
        // Função para filtrar locais
        function filterLocations() {
            const searchTerm = searchInput.value.toLowerCase();
            const typeValue = typeFilter.value;
            const sortValue = sortFilter.value;
            
            let visibleCount = 0;
            let cardsArray = Array.from(locationCards);
            
            // Aplicar filtros
            cardsArray.forEach(card => {
                const name = card.querySelector('h3').textContent.toLowerCase();
                const description = card.querySelector('p').textContent.toLowerCase();
                const type = card.getAttribute('data-type');
                
                const matchesSearch = name.includes(searchTerm) || description.includes(searchTerm);
                const matchesType = typeValue === 'all' || type === typeValue;
                
                if (matchesSearch && matchesType) {
                    card.style.display = 'block';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });
            
            // Ordenar resultados
            if (sortValue === 'name') {
                cardsArray.sort((a, b) => {
                    const nameA = a.querySelector('h3').textContent.toLowerCase();
                    const nameB = b.querySelector('h3').textContent.toLowerCase();
                    return nameA.localeCompare(nameB);
                });
            } else if (sortValue === 'oldest') {
                // Implementação simplificada - em produção, usar dados reais
                cardsArray.reverse();
            }
            
            // Reorganizar grid com a nova ordem
            if (sortValue !== 'newest') {
                locationsGrid.innerHTML = '';
                cardsArray.forEach(card => {
                    if (card.style.display !== 'none') {
                        locationsGrid.appendChild(card);
                    }
                });
            }
            
            // Atualizar contador
            resultsCount.textContent = `${visibleCount} local(is) encontrado(s)`;
        }
        
        // Event listeners para filtros
        searchInput.addEventListener('input', filterLocations);
        typeFilter.addEventListener('change', filterLocations);
        sortFilter.addEventListener('change', filterLocations);
        
        // Funcionalidade de exclusão (simulação)
        document.querySelectorAll('.btn-delete').forEach(button => {
            button.addEventListener('click', function() {
                const locationId = this.getAttribute('data-id');
                const locationName = this.getAttribute('data-name');
                
                if (confirm(`Tem certeza que deseja excluir o local "${locationName}"? Esta ação não pode ser desfeita.`)) {
                    // Simulação de exclusão
                    const card = this.closest('.location-card');
                    card.style.transform = 'scale(0.9)';
                    card.style.opacity = '0.5';
                    this.disabled = true;
                    this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Excluindo...';
                    
                    setTimeout(() => {
                        card.style.display = 'none';
                        // Em um sistema real, faria uma requisição AJAX para excluir do banco
                        // e atualizaria as estatísticas
                        alert(`Local "${locationName}" excluído com sucesso!`);
                        location.reload(); // Recarregar para atualizar estatísticas
                    }, 1500);
                }
            });
        });
        
        // Inicializar filtros
        document.addEventListener('DOMContentLoaded', function() {
            filterLocations();
            
            // Adicionar efeito de digitação no título
            const title = document.querySelector('.page-title');
            const text = title.textContent;
            title.textContent = '';
            let i = 0;
            
            function typeWriter() {
                if (i < text.length) {
                    title.textContent += text.charAt(i);
                    i++;
                    setTimeout(typeWriter, 100);
                }
            }
            
            setTimeout(typeWriter, 500);
        });
    </script>
</body>
</html> 