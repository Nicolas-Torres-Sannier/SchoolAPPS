<?php
require_once 'cont_admin.php';

class ModAdmin extends ModeleGenerique
{
    public function __construct($url)
    {
        $controllAdmin = new ContAdmin();

        ob_start();
        if (isset($_SESSION['idTypeUtilisateur']) && $_SESSION['idTypeUtilisateur'] == 1) {
            if (isset($url[1])) {
                $action = $url[1];
                switch ($action) {
                    case 'mes-informations':
                        $controllAdmin->profil();
                        break;
                    case 'nouveau-mot-de-passe':
                        $controllAdmin->nouveauMotDePasse();
                        break;
                    case 'changer-login':
                        $controllAdmin->nouveauLogin();
                        if (isset($url[2]) && $url === 'verif') {
                            $controllAdmin->soumettreLogin();
                        }
                        break;
                    case 'tickets-fermes':
                        $controllAdmin->afficherTicketsFerme();
                        break;
                    case 'tickets-en-cours':
                        $controllAdmin->afficherTicketsEncours();
                        break;
                    case 'tickets-urgent':
                        $controllAdmin->afficherTicketsUrgent();
                        break;
                    case 'tickets-en-attente':
                        $controllAdmin->afficherTicketsEnAttente();
                        break;
                    case 'ticket':
                        if (isset($url[2])) {
                            $controllAdmin->afficherTicket($url[2]);
                        } else {
                            $controllAdmin->actionInexistante();
                        }
                        break;
                    case 'supprimer-ticket':
                        $controllAdmin->supprimerTicket();
                        break;
                    case 'assigner-ticket':
                        $controllAdmin->assignerTicket();
                        break;
                        /*  case 'discussion':
                        $controllAdmin->discussion();
                        break; */
                    case 'liste-techniciens':
                        $controllAdmin->listeTechniciens();
                        break;
                    case 'nouveau-technicien':
                        $controllAdmin->nouveauTechnicien();
                        break;
                    case 'supprimerTechnicien':
                        $controllAdmin->supprimerTechnicien($url[2]);
                        break;
                    case 'statistique':
                        $controllAdmin->statistique();
                        break;
                    default:
                        $controllAdmin->actionInexistante();
                        break;
                }
            } else {
                $controllAdmin->tableauBord();
            }
            $moduleContent = ob_get_clean();

            $controllAdmin->accueilAdmin($moduleContent, $url);
        } else
            $controllAdmin->vue->pasConnecté();
    }
}

?>

<?php
$modAdmin = new ModAdmin((isset($url)) ? $url : null);
?>