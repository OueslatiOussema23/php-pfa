using Microsoft.AspNetCore.Mvc;
using Microsoft.AspNetCore.Mvc.RazorPages;

public class LoginModel : PageModel
{
    [BindProperty]
    public string Email { get; set; }

    [BindProperty]
    public string Password { get; set; }

    public string ErrorMessage { get; set; }

    public IActionResult OnPost()
    {
        // Vérification simple 
        if (string.IsNullOrEmpty(Email) || string.IsNullOrEmpty(Password))
        {
            ErrorMessage = "Tous les champs sont obligatoires";
            return Page();
        }

        if (Email == "admin@example.com" && Password == "password")
        {
            // Redirection 
            return RedirectToPage("Dashboard");
        }

        // Message erreur (remplace $_SESSION["login-error"])
        ErrorMessage = "Email ou mot de passe incorrect";

        return Page();
    }
}