# 🏠 **M2L - Site Dynamique**

## 🌟 **Description**

Bienvenue sur le projet **M2L**, un site dynamique en **PHP** pour la **Maison des Ligues de Lorraine (M2L entité fictive)**. Ce projet évolue à partir d'un site statique afin de permettre la gestion des **ligues**, **clubs affiliés** et **formations** proposées par la M2L. Grâce à une interface dynamique, les utilisateurs peuvent facilement consulter et gérer ces informations, en fonction de leur rôle au sein de la M2L.

### 🎯 **Objectif principal**
Ce projet permet aux **secrétaires**, **responsables de formation**, et **responsables des ressources humaines** de gérer efficacement les ligues et clubs affiliés à la M2L, tout en garantissant une gestion conforme des données personnelles.

---

## 🚀 **Fonctionnalités** 🌟

Le site est structuré autour de trois grands rôles, chacun ayant des fonctionnalités spécifiques :

### 1. **Pour les Secrétaires** 📝
- **Gestion des ligues** : Ajouter, modifier, supprimer des ligues.
- **Gestion des clubs** : Ajouter, modifier, supprimer des clubs et les rattacher à des ligues spécifiques.

### 2. **Pour les Responsables de Formation** 📚
- **Gestion des formations** : Proposer et gérer des formations destinées aux ligues et clubs affiliés.

### 3. **Pour les Responsables des Ressources Humaines** 👩‍💻
- **Gestion des intervenants** : Suivi des informations des intervenants, y compris les bulletins de salaire et contrats.

### 4. **Pour tous les utilisateurs** 👥
- **Consultation des ligues et clubs** : Les utilisateurs peuvent consulter la liste des ligues et clubs, que ce soit en mode connecté ou déconnecté.

---

## 💻 **Installation & Configuration** 🛠️

### Prérequis

Avant de commencer, assurez-vous de disposer de ces éléments :

- **WampServer** (ou tout autre environnement PHP local avec Apache et MySQL)
- **Visual Studio Code** (ou tout éditeur de texte de votre choix)
- Une installation de **PHP** et **MySQL**

### Étapes d'installation 🚀

#### 1️⃣ **Démarrer WampServer**
- Ouvrez **WampServer** et assurez-vous que les services **Apache** et **MySQL** sont bien lancés.

#### 2️⃣ **Configurer un VirtualHost**
- Dans **WampServer**, allez dans **Gestion des VirtualHosts**.
- Créez un VirtualHost pointant vers le dossier où vous avez téléchargé ce projet **PHP**.
- L'URL de votre VirtualHost doit être configurée pour correspondre à l'emplacement du dossier PHP.

#### 3️⃣ **Importer la base de données**
- Ouvrez **phpMyAdmin** via WampServer.
- Importez la base de données à partir du fichier `.sql` fourni dans le projet.

#### 4️⃣ **Configurer la connexion à la base de données**
- Ouvrez le dossier du projet dans **Visual Studio Code**.
- Modifiez le fichier **Param.php** pour y indiquer les identifiants de connexion à votre base de données (utilisateur et mot de passe).
- Assurez-vous que le **dsn** contient le bon nom de base de données dans la ligne `dbName`.

#### 5️⃣ **Lancer l'application**
- Ouvrez votre navigateur et accédez à l'URL de votre VirtualHost.
- Vous êtes maintenant prêt à gérer les ligues, les clubs et les formations !

---

## 📈 **Technologies utilisées** 🖥️

Le projet repose sur les technologies suivantes :

- **PHP** : Langage principal du backend.
- **MySQL** : Base de données pour stocker les informations des ligues, clubs et formations.
- **HTML5/CSS3** : Structure et mise en page du site.

---

🎉 **Merci de votre visite !** 👋

---
