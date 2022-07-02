let notification = document.getElementById("notification")
let notification_icon = document.getElementById("notification_icon")
let notification_title = document.getElementById("notification_title")
let notification_content = document.getElementById("notification_content")

function notifySuccess(title, content, expire) {
    if (!title || !content) return
    notification_icon.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="text-green-500" viewBox="0 0 16 16"><path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/></svg>`
    notification_title.innerHTML = title
    notification_content.innerHTML = content
    fadeIn(notification, 1000, "flex")

    setTimeout(function() {
        fadeOut(notification, 1000)
    }, expire * 1000)
}

function notifyError(title, content, expire) {
    if (!title || !content) return
    notification_icon.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="text-red-500" viewBox="0 0 16 16"><path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/></svg>`
    notification_title.innerHTML = title
    notification_content.innerHTML = content
    fadeIn(notification, 1000, "flex")

    setTimeout(function() {
        fadeOut(notification, 1000)
    }, expire * 1000)
}

function notifyWarning(title, content, expire) {
    if (!title || !content) return
    notification_icon.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="text-orange-500" viewBox="0 0 16 16"><path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/></svg>`
    notification_title.innerHTML = title
    notification_content.innerHTML = content
    fadeIn(notification, 1000, "flex")

    setTimeout(function() {
        fadeOut(notification, 1000)
    }, expire * 1000)
}

function fadeIn(element, time, display) {
    element.style.opacity = 0
    element.style.display = display
    var last = +new Date()
    var tick = function() {
        element.style.opacity = +element.style.opacity + (new Date() - last) / time
        last = +new Date()

        if (+element.style.opacity < 1) {
            (window.requestAnimationFrame && requestAnimationFrame(tick)) || setTimeout(tick, 16)
        }
    }

    tick()
}

function fadeOut(element, time) {
    var last = +new Date()
    var tick = function() {
        element.style.opacity = +element.style.opacity - (new Date() - last) / time
        last = +new Date()

        if (+element.style.opacity > 0) {
            (window.requestAnimationFrame && requestAnimationFrame(tick)) || setTimeout(tick, 16)
        } else {
            element.style.display = "none"
        }
    }

    tick()
}

if (document.getElementById("launch_installation")) {

    document.getElementById("launch_installation").addEventListener("click", function() {
        $.ajax({
            url: "../assets/scripts/launch_install.php",
            method: "POST"
        }).done(function (response) {
            if (response == "success") {
                notifySuccess("Installation lancée", "L'installation de la base de données à été effectuée", 1)
                setTimeout(function() {
                    window.location.reload()
                }, 1000)
            } else if (response == "infos_file_exists") {
                notifyWarning("Installation déja lancée", "L'installation du site à déja commencé, rechargez la page", 3)
                console.log(response)
            } else {
                notifyError("Erreur lors de l'installation", "Une erreur est survenue lors de l'installation de la base de données", 3)
                console.log(response)
            }
        }).fail(function () {
            notifyError("Erreur", "Une erreur est survenue lors de l'installation, veuillez réessayer", 3)
        })
    })
}

if (document.getElementById("admin_create")) {
    document.getElementById("admin_create").addEventListener("click", function() {
        $.ajax({
            url: "../assets/scripts/create_admin.php",
            method: "POST",
            data: {
                username: document.getElementById("admin_username").value,
                password: document.getElementById("admin_password").value,
                password_confirm: document.getElementById("admin_password_confirm").value,
                mail: document.getElementById("admin_mail").value,
            }
        }).done(function (response) {
            if (response == "success") {
                notifySuccess("Administrateur créé", "L'administrateur a été créé", 1)
                setTimeout(function() {
                    window.location.reload()
                }, 1000)
            } else if (response == "username_exists") {
                notifyWarning("Nom d'utilisateur existant", "Ce nom d'utilisateur est déja utilisée", 3)
            } else if (response == "fields_required") {
                notifyWarning("Champs manquants", "Veuillez remplir tous les champs", 3)
            } else if (response == "pass_not_match") {
                notifyWarning("Mot de passe non identique", "Les mots de passe ne correspondent pas", 3)
            } else if (response == "pass_too_short") {
                notifyWarning("Mot de passe non sécurisé", "Le mot de passe doit contenir au moins 8 caractères", 3)
            } else if (response == "mail_exists") {
                notifyWarning("Adresse mail existante", "Cette adresse mail est déja utilisée", 3)
            } else if (response == "mail_not_valid") {
                notifyWarning("Adresse mail non valide", "Cette adresse mail n'est pas valide", 3)
            } else if (response == "pass_not_secure") {
                notifyWarning("Mot de passe non sécurisé", "Ce mot de passe n'est pas sécurisé, merci de choisir un autre", 3)
            } else {
                notifyError("Erreur lors de la création", "Une erreur est survenue lors de la création de l'administrateur", 3)
                console.log(response)
            }
        }).fail(function () {
            notifyError("Erreur", "Une erreur est survenue lors de la création, veuillez réessayer", 3)
        })
    })
}

if (document.getElementById("start_btn")) {
    document.getElementById("start_btn").addEventListener("click", function() {
        $.ajax({
            url: "../assets/scripts/stop_install.php",
            method: "POST"
        }).done(function (response) {
            if (response == "success") {
                window.location.reload()
            } else {
                notifyError("Erreur lors du démarrage", "Une erreur est survenue lors du démarrage du site", 3)
                console.log(response)
            }
        }).fail(function () {
            notifyError("Erreur", "Une erreur est survenue lors du démarrage, veuillez réessayer", 3)
        })
    })
}