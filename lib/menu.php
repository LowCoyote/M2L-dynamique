<?php
/**
 * Classe Menu
 * Permet de crréer des menus
 * $style style css
 * $composants liste des items coposant le menu
 */
class Menu{
	private $style;
	private $composants = [];

	/**
	 * Constructeur de la classe Menu
	 * @param $unStyle (style pour css)
	 */
	public function __construct($unStyle ){
		$this->style = $unStyle;
	}

	/**
	 * Ajoute un item à la liste des items du menu
	 * @param $unComposant (un item du menu)
	 */
	public function ajouterComposant($unComposant){
		$this->composants[] = $unComposant;
	}


	/**
	 * Crée un nouvelle item pour le menu
	 * @param $unLien  (valeur transmise)
	 * @param $uneValeur (valeur affichée)
	 * @return un item pour le menu
	 */
	public function creerItemLien($unLien,$uneValeur){
		$composant = array();
		$composant[0] = $unLien ;
		$composant[1] = $uneValeur ;
		return $composant;
	}

	/**
	 * crée le menu à afficher
	 * @param $composantActif (item sélectionné)
	 * @param $nomMenu (nom variable transmise)
	 */
	public function creerMenu($composantActif,$nomMenu){
		$menu = "<ul class = '" .  $this->style . "'>";
		foreach($this->composants as $composant){
			if($composant[0] == $composantActif){
				$menu .= "<li class='actif'>";
				$menu .=  "<span>" . $composant[1] ."</span>";
			}
			else{
				$menu .= "<li>";
				$menu .= "<a href='index.php?" . $nomMenu ;
				$menu .= "=" . $composant[0] . "' >";
				$menu .= "<span>" . $composant[1] ."</span>";
				$menu .= "</a>";
			}
			$menu .= "</li>";
		}
		$menu .= "</ul>";
		return $menu ;
	}

    /**
     * crée le menu à afficher
     * @param $composantActif (item sélectionné)
     * @param $nomMenu (nom variable transmise)
     */
    public function creerMenu2($composantActif,$nomMenu, $titreListe){

        $titre = "<h3 class='titreListe'>" .  $titreListe . "</h3>";

        $menu = "<ul class = '" .  $this->style . "'>";
        foreach($this->composants as $composant){
            if($composant[0] == $composantActif){
                $menu .= "<li class='actif'>";
                $menu .=  "<span>" . $composant[1] ."</span>";
            }
            else{
                $menu .= "<li>";
                $menu .= "<a href='index.php?" . $nomMenu ;
                $menu .= "=" . $composant[0] . "' >";
                $menu .= "<span>" . $composant[1] ."</span>";
                $menu .= "</a>";
            }
            $menu .= "</li>";
        }
        $menu .= "</ul>";
        return $titre.$menu ;
    }
 /*
    public function creerMenuEquipe($composantActif){
        $menu = "<ul class = '" .  $this->style . "'>";
        foreach($this->composants as $composant){
            if($composant[0] == $composantActif){
                $menu .= "<li class='actif'>";
                $menu .= "<img src='images/" . strtolower($composant[1]) . ".png'>";
                $menu .=  $composant[1] ;
            }
            else{
                $menu .= "<li>";
                $menu .= "<a href='index.php?action=afficher" ;
                $menu .= "&equipe=" . $composant[0] . "' ><img src='images/" . strtolower($composant[1]) . ".png'>";
                $menu .= $composant[1] ;
                $menu .= "</a>";
            }
            $menu .= "</li>";
        }
        $menu .= "</ul>";
        return $menu ;
    }*/




}