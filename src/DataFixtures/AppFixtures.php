<?php

namespace App\DataFixtures;

use App\Entity\City;
use App\Entity\Flag;
use App\Entity\Pays;
use App\Entity\Domain;
use App\Entity\Gender;
use App\Entity\JobType;
use App\Entity\JobGrade;
use App\Entity\Language;
use App\Entity\CompanySize;
use App\Entity\CompanyType;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class AppFixtures extends Fixture
{
    private $kernel;

    public function __construct(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }

    public function load(ObjectManager $manager)
    {
        $imgDir = $this->kernel->getProjectDir() . '/public/img/flags';
        $newDir = $this->kernel->getProjectDir() . '/public/upload/img/flags';

        $countries = [
            'Algérie' => [
                'flag' => 'algeria.svg',
                'cities' => ['Alger', 'Oran', 'Constantine', 'Annaba'],
                'photos' => ['photo1.jpg', 'photo2.jpg', 'photo3.jpg'],
                'languages' => ['Arabe', 'Berbère', 'Français'],

            ],
            'Angola' => [
                'flag' => 'angola.svg',
                'cities' => ['Luanda', 'Lobito', 'Huambo', 'Benguela'],
                'languages' => ['Portugais', 'Ovimbundu', 'Kimbundu']
            ],
            'Bénin' => [
                'flag' => 'benin.svg',
                'cities' => ['Cotonou', 'Porto-Novo', 'Parakou', 'Abomey-Calavi'],
                'languages' => ['Français', 'Fon', 'Yoruba']
            ],
            'Botswana' => [
                'flag' => 'botswana.svg',
                'cities' => ['Gaborone', 'Francistown', 'Molepolole', 'Serowe'],
                'languages' => ['Anglais', 'Tswana', 'Kalahari']
            ],
            'Burkina Faso' => [
                'flag' => 'burkina_faso.svg',
                'cities' => ['Ouagadougou', 'Bobo-Dioulasso', 'Koudougou', 'Ouahigouya'],
                'languages' => ['Français', 'Mossi', 'Fulfulde']
            ],
            'Burundi' => [
                'flag' => 'burundi.svg',
                'cities' => ['Bujumbura', 'Gitega', 'Ngozi', 'Muyinga'],
                'languages' => ['Kirundi', 'Français', 'Anglais']
            ],
            'Cameroun' => [
                'flag' => 'cameroun.svg',
                'cities' => ['Yaoundé', 'Douala', 'Bamenda', 'Bafoussam'],
                'languages' => ['Français', 'Anglais', 'Pidgin']
            ],
            'Cap-Vert' => [
                'flag' => 'cape_verde.svg',
                'cities' => ['Praia', 'Mindelo', 'Assomada', 'Tarrafal'],
                'languages' => ['Portugais', 'Capverdien', 'Crioulo']
            ],
            'Chad' => [
                'flag' => 'chad.svg',
                'cities' => ['N\'Djamena', 'Moundou', 'Sarh', 'Abéché'],
                'languages' => ['Français', 'Arabe', 'Sara']
            ],
            'Cueta' => [
                'flag' => 'cueta.svg',
                'cities' => ['Ceuta Centro', 'El Príncipe Alfonso', 'Benzú', 'El Sarchal', 'Monte Hacho'],
                'languages' => ['Espagnol']
            ],
            'Comores' => [
                'flag' => 'comoros.svg',
                'cities' => ['Moroni', 'Mutsamudu', 'Fomboni', 'Domoni', 'Mirontsi'],
                'languages' => ['Comorien', 'Arabe', 'Français']
            ],
            'République du Congo' => [
                'flag' => 'republic_of_the_congo.svg',
                'cities' => ['Brazzaville', 'Pointe-Noire', 'Dolisie', 'Nkayi', 'Owando', 'Impfondo', 'Sibiti', 'Kinkala'],
                'languages' => ['Français', 'Lingala', 'Kikongo']
            ],
            'République démocratique du Congo' => [
                'flag' => 'democratic_Republic_of_the_congo.svg',
                'cities' => ['Kinshasa', 'Lubumbashi', 'Mbuji-Mayi', 'Kisangani', 'Goma', 'Bukavu', 'Kananga', 'Matadi', 'Kisangani', 'Bunia'],
                'languages' => ['Français', 'Lingala', 'Swahili', 'Tshiluba']
            ],
            'Côte d\'Ivoire' => [
                'flag' => 'cote_d\'ivoire.svg',
                'cities' => ['Abidjan', 'Yamoussoukro', 'Bouaké', 'Daloa', 'San Pedro', 'Korhogo', 'Man', 'Séguéla', 'Divo', 'Gagnoa'],
                'languages' => ['Français', 'Baoulé', 'Bété', 'Sénoufo']
            ],
            'Djibouti' => [
                'flag' => 'djibouti.svg',
                'cities' => ['Djibouti', 'Ali Sabieh', 'Tadjourah', 'Obock', 'Dikhil'],
                'languages' => ['Français', 'Arabe', 'Afar']
            ],
            'Égypte' => [
                'flag' => 'egypt.svg',
                'cities' => ['Le Caire', 'Alexandrie', 'Gizeh', 'Louxor', 'Assouan', 'Port-Saïd', 'Suez', 'Ismaïlia'],
                'languages' => ['Arabe', 'Anglais']
            ],
            'Gabon' => [
                'flag' => 'gabon.svg',
                'cities' => ['Libreville', 'Port-Gentil', 'Franceville', 'Oyem', 'Moanda', 'Mouila', 'Tchibanga', 'Koulamoutou'],
                'languages' => ['Français', 'Fang', 'Mbéré']
            ],
            'Ghana' => [
                'flag' => 'ghana.svg',
                'cities' => ['Accra', 'Kumasi', 'Tamale', 'Sekondi-Takoradi', 'Cape Coast', 'Sunyani', 'Tema', 'Bolgatanga'],
                'languages' => ['Anglais', 'Akan', 'Mole-Dagbon']
            ],
            'Guinée' => [
                'flag' => 'guinea.svg',
                'cities' => ['Conakry', 'Nzérékoré', 'Kankan', 'Kindia', 'Labé', 'Mamou', 'Kamsar', 'Boke'],
                'languages' => ['Français', 'Poular', 'Malinké']
            ],
            'Guinée-Bissau' => [
                'flag' => 'guinea-bissau.svg',
                'cities' => ['Bissau', 'Bafatá', 'Gabú', 'Canchungo'],
                'languages' => ['Portugais', 'Crioulo']
            ],
            'Guinée équatoriale' => [
                'flag' => 'equatorial_guinea.svg',
                'cities' => ['Malabo', 'Bata', 'Ebebiyin', 'Mongomo'],
                'languages' => ['Espagnol', 'Français']
            ],
            'Kenya' => [
                'flag' => 'kenya.svg',
                'cities' => ['Nairobi', 'Mombasa', 'Kisumu', 'Nakuru'],
                'languages' => ['Swahili', 'Anglais', 'Kikuyu']
            ],
            'Lesotho' => [
                'flag' => 'lesotho.svg',
                'cities' => ['Maseru', 'Teyateyaneng', 'Leribe', 'Mafeteng'],
                'languages' => ['Sesotho', 'Anglais', 'Zoulou']
            ],
            'Liberia' => [
                'flag' => 'liberia.svg',
                'cities' => ['Monrovia', 'Ganta', 'Buchanan', 'Kakata'],
                'languages' => ['Anglais']
            ],
            'Libye' => [
                'flag' => 'libya.svg',
                'cities' => ['Tripoli', 'Benghazi', 'Misrata', 'Sirte'],
                'languages' => ['Arabe']
            ],
            'Madagascar' => [
                'flag' => 'madagascar.svg',
                'cities' => ['Antananarivo', 'Toamasina', 'Antsirabe', 'Fianarantsoa', 'Diego', 'Mahajanga', 'Toliara'],
                'languages' => ['Malgache', 'Français']
            ],
            'Malawi' => [
                'flag' => 'malawi.svg',
                'cities' => ['Lilongwe', 'Blantyre', 'Mzuzu', 'Zomba'],
                'languages' => ['Chichewa', 'Anglais']
            ],
            'Mali' => [
                'flag' => 'mali.svg',
                'cities' => ['Bamako', 'Sikasso', 'Mopti', 'Segou'],
                'languages' => ['Français', 'Bambara']
            ],
            'Mauritanie' => [
                'flag' => 'mauritania.svg',
                'cities' => ['Nouakchott', 'Nouadhibou', 'Kaédi', 'Zouérat'],
                'languages' => ['Arabe']
            ],
            'Maurice' => [
                'flag' => 'mauritius.svg',
                'cities' => ['Port-Louis', 'Beau-Bassin Rose-Hill', 'Vacoas-Phoenix', 'Curepipe'],
                'languages' => ['Français', 'Anglais', 'Créole mauricien']
            ],
            'Maroc' => [
                'flag' => 'morocco.svg',
                'cities' => ['Rabat', 'Casablanca', 'Fès', 'Marrakech'],
                'languages' => ['Arabe', 'Berbère', 'Français']
            ],
            'Mozambique' => [
                'flag' => 'mozambique.svg',
                'cities' => ['Maputo', 'Matola', 'Beira', 'Nampula'],
                'languages' => ['Portugais', 'Emakhuwa']
            ],
            'Namibie' => [
                'flag' => 'namibia.svg',
                'cities' => ['Windhoek', 'Rundu', 'Walvis Bay', 'Swakopmund'],
                'languages' => ['Anglais', 'Afrikaans', 'Oshiwambo']
            ],
            'Niger' => [
                'flag' => 'niger.svg',
                'cities' => ['Niamey', 'Zinder', 'Maradi', 'Agadez'],
                'languages' => ['Français', 'Arabe', 'Hausa']
            ],
            'Nigeria' => [
                'flag' => 'nigeria.svg',
                'cities' => ['Lagos', 'Kano', 'Ibadan', 'Abuja'],
                'languages' => ['Anglais', 'Yoruba', 'Hausa', 'Igbo']
            ],
            'Ouganda' => [
                'flag' => 'uganda.svg',
                'cities' => ['Kampala', 'Mbarara', 'Jinja', 'Gulu'],
                'languages' => ['Anglais', 'Swahili', 'Luganda']
            ],
            'Rwanda' => [
                'flag' => 'rwanda.svg',
                'cities' => ['Kigali', 'Butare', 'Gitarama', 'Ruhengeri'],
                'languages' => ['Kinyarwanda', 'Anglais', 'Français']
            ],
            'Sao Tomé-et-Principe' => [
                'flag' => 'sao_tome_and_principe.svg',
                'cities' => ['São Tomé', 'Santo António', 'São João dos Angolares', 'Neves'],
                'languages' => ['Portugais']
            ],
            'Sénégal' => [
                'flag' => 'senegal.svg',
                'cities' => ['Dakar', 'Thiès', 'Kaolack', 'Ziguinchor'],
                'languages' => ['Français', 'Wolof', 'Pulaar']
            ],
            'Seychelles' => [
                'flag' => 'seychelles.svg',
                'cities' => ['Victoria', 'Anse Boileau', 'Bel Ombre', 'Beau Vallon'],
                'languages' => ['Seychellois Creole', 'Anglais', 'Français']
            ],
            'Sierra Leone' => [
                'flag' => 'sierra_leone.svg',
                'cities' => ['Freetown', 'Bo', 'Kenema', 'Makeni'],
                'languages' => ['Anglais', 'Krio']
            ],
            'Somalie' => [
                'flag' => 'somalia.svg',
                'cities' => ['Mogadishu', 'Hargeisa', 'Bosaso', 'Kismayo'],
                'languages' => ['Somali', 'Arabe']
            ],
            'Afrique du Sud' => [
                'flag' => 'south_africa.svg',
                'cities' => ['Johannesburg', 'Cape Town', 'Durban', 'Pretoria'],
                'languages' => ['Afrikaans', 'Anglais', 'Zoulou', 'Xhosa']
            ],
            'Soudan' => [
                'flag' => 'sudan.svg',
                'cities' => ['Khartoum', 'Omdurman', 'Port Sudan', 'Kassala'],
                'languages' => ['Arabe', 'Anglais']
            ],
            'Soudan du Sud' => [
                'flag' => 'south_sudan.svg',
                'cities' => ['Juba', 'Wau', 'Malakal', 'Bor'],
                'languages' => ['Anglais', 'Arabe']
            ],
            'Eswatini' => [
                'flag' => 'eswatini.svg',
                'cities' => ['Mbabane', 'Manzini', 'Big Bend', 'Malkerns'],
                'languages' => ['Swazi', 'Anglais']
            ],
            'Tanzanie' => [
                'flag' => 'tanzania.svg',
                'cities' => ['Dodoma', 'Dar es Salaam', 'Mwanza', 'Arusha'],
                'languages' => ['Swahili', 'Anglais']
            ],
            'Togo' => [
                'flag' => 'togo.svg',
                'cities' => ['Lomé', 'Sokodé', 'Kara', 'Palimé'],
                'languages' => ['Français', 'Éwé', 'Kabyè']
            ],
            'Tunisie' => [
                'flag' => 'tunisia.svg',
                'cities' => ['Tunis', 'Sfax', 'Sousse', 'Kairouan'],
                'languages' => ['Arabe', 'Français']
            ],
            'Zambie' => [
                'flag' => 'zambia.svg',
                'cities' => ['Lusaka', 'Ndola', 'Kitwe', 'Kabwe'],
                'languages' => ['Anglais', 'Bemba', 'Nyanja']
            ],
            'Zimbabwe' => [
                'flag' => 'zimbabwe.svg',
                'cities' => ['Harare', 'Bulawayo', 'Chitungwiza', 'Mutare'],
                'languages' => ['Anglais', 'Shona', 'Ndebele']
            ],
            ];
            foreach ($countries as $name => $country) {
                if (!is_array($country)) {
                    continue;
                }
            
                $pays = new Pays();
                $pays->setName($name);
            
                $flag = new Flag();
                $newPath = $newDir . '/' . $country['flag'];
                copy($imgDir . '/' . $country['flag'], $newPath);
                $flagFile = new UploadedFile($newPath, $country['flag'], null, null, true);
                $flag->setFile($flagFile);
                $pays->setFlag($flag);
            
                if (isset($country['languages']) && is_array($country['languages'])) {
                    foreach ($country['languages'] as $language) {
                        $lang = new Language();
                        $lang->setLanguage($language);
                        $lang->addPay($pays);
            
                        $manager->persist($lang);
                    }
                }
            
                $manager->persist($pays);
            
                if (isset($country['cities']) && is_array($country['cities'])) {
                    foreach ($country['cities'] as $cityName) {
                        $city = new City();
                        $city->setName($cityName);
                        $city->setCountry($pays);
            
                        $manager->persist($city);
                    }
                }
            }
            
            
              
        


        $jobGrades = [
            "Etudiant",
            "Junior",
            "Senior"
        ];
        $jobTypes = [
            "Temps plein",
            "Temps partiel",
            "CDI",
            "CDD",
            "Alternance",
            "Teletravail/Freelance",
            "Stage",
        ];
        $genders = [
            "Homme",
            "Femme",
            "Autre"
        ];
        $companySizes = [
            "1-10",
            "10-30",
            "30-50",
            "50-100",
            "100+"
        ];
        $domains = [
            "Technologie de l'information",
            "Santé",
            "Finance",
            "Énergie",
            "Transport",
            "Éducation",
            "Immobilier",
            "Automobile",
            "Agriculture",
            "Alimentation et boissons",
            "Mode",
            "Tourisme",
            "Divertissement",
            "Télécommunications",
            "Assurance",
            "Construction",
            "Industrie pharmaceutique",
            "Logistique",
            "Marketing",
            "Médias",
            "Aérospatiale",
            "Hôtellerie",
            "Consulting",
            "Services juridiques",
            "Biotechnologie",
            "Environnement",
            "Sport",
            "Chimie",
            "Ingénierie",
            "Gestion des déchets",
            "Électronique",
            "Agence immobilière",
            "Sécurité",
            "Gestion des ressources humaines",
            "Services financiers",
            "Joaillerie",
            "Agroalimentaire",
            "Audiovisuel",
            "Arts",
            "Audio",
            "Tabac",
            "Équipements médicaux",
            "Édition",
            "Événementiel",
            "Services gouvernementaux",
            "Textile",
            "Architecture",
            "Restauration",
            "Équipements sportifs",
            "Électronique grand public",
            "Jouets",
            "Pétrole et gaz",
            "Équipements industriels",
            "Éducation supérieure",
            "Papeterie",
            "Équipements de bureau",
            "Artisanat",
            "Équipements de loisirs",
            "Photographie",
            "Assistance technique",
            "Matériaux de construction",
            "Santé animale",
            "Vins et spiritueux",
            "Formation en ligne",
            "Fabrication",
            "Services internet",
            "Énergie renouvelable",
            "Équipements agricoles",
            "Énergie solaire",
            "Aménagement paysager",
            "Bijouterie",
            "Horlogerie",
            "Jeux vidéo",
            "Services sociaux",
            "Plomberie",
            "Équipements audiovisuels",
            "Équipements de sécurité",
            "Mobilier",
            "Cinéma",
            "Électronique automobile",
            "Équipements de cuisine",
            "Design",
            "Jardinerie",
            "Restauration rapide",
            "Réparation automobile",
            "Équipements de plongée",
            "Publicité",
            "Informatique",
            "Produits chimiques de nettoyage",
            "Habillement de travail",
            "Équipements de camping",
            "Édition en ligne",
            "Équipements de pêche",
            "Équipements de golf",
            "Équipements de paintball",
            "Équipements de cyclisme",
            "Équipements de natation",
            "Équipements de ski",
        ];

        $companyTypes = [
            "Startup",
            "Entreprise individuelle",
            "Société anonyme (SA)",
            "Société à responsabilité limitée (SARL)",
            "Entreprise familiale",
            "Entreprise publique",
            "Coopérative",
            "Association",
            "Entreprise sociale",
            "Entreprise multinationale",
            "Entreprise artisanale",
            "Entreprise innovante",
            "Entreprise technologique",
            "Entreprise de services",
            "Entreprise manufacturière",
            "Entreprise de vente au détail",
            "Entreprise en ligne",
            "Entreprise de conseil",
            "Entreprise de construction",
            "Entreprise agroalimentaire",
            "Entreprise pharmaceutique",
            "Entreprise de logistique",
            "Entreprise de transport",
            "Entreprise de médias",
            "Entreprise de divertissement",
            "Entreprise de télécommunications",
            "Entreprise d'énergie",
            "Entreprise de gestion des déchets",
            "Entreprise d'ingénierie",
            "Entreprise de sécurité",
            "Entreprise de recyclage",
            "Entreprise d'architecture",
            "Entreprise de design",
            "Entreprise de développement web",
            "Entreprise de marketing numérique",
            "Entreprise de formation en ligne",
            "Entreprise de tourisme",
            "Entreprise de restauration",
            "Entreprise de construction navale",
            "Entreprise de vente en gros",
            "Entreprise de technologie propre",
            "Entreprise de recyclage électronique",
            "Entreprise sociale et solidaire",
            "Entreprise culturelle",
            "Entreprise d'art et de design",
            "Entreprise humanitaire",
            "Entreprise de recherche et développement",
            "Entreprise de sécurité informatique",
            "Entreprise de génie civil",
            "Entreprise de gestion des ressources humaines",
            "Entreprise de conseil en gestion",
            "Entreprise de fabrication de produits chimiques",
            "Entreprise de fabrication d'équipements médicaux",
            "Entreprise de mode éthique",
            "Entreprise d'éducation",
            "Entreprise d'architecture d'intérieur",
            "Entreprise de conception de jeux vidéo",
            "Entreprise de gestion d'événements",
            "Entreprise de conception graphique",
            "Entreprise de développement durable",
            "Entreprise de conception de logiciels",
            "Entreprise de gestion de projet",
            "Entreprise de développement mobile",
            "Entreprise de commerce électronique",
            "Entreprise de sécurité alimentaire",
            "Entreprise de fabrication de meubles",
            "Entreprise de design d'expérience utilisateur",
            "Entreprise de développement durable",
            "Entreprise de téléphonie mobile",
            "Entreprise de services financiers",
            "Entreprise de production audiovisuelle",
            "Entreprise de gestion immobilière",
            "Entreprise de restauration rapide",
            "Entreprise de santé et de bien-être",
            "Entreprise de cosmétiques",
            "Entreprise de gestion de projet",
            "Entreprise de développement de jeux éducatifs",
            "Entreprise de fabrication de matériaux de construction",
            "Entreprise de gestion des ressources naturelles",
            "Entreprise de fabrication de produits électroniques",
            "Entreprise de fabrication de textiles",
            "Entreprise de conception de logiciels",
            "Entreprise de commerce de gros",
            "Entreprise de fabrication de produits alimentaires",
            "Entreprise de développement de logiciels",
            "Entreprise de vente au détail en ligne",
            "Entreprise de transport de marchandises",
            "Entreprise de commerce équitable",
            "Entreprise de gestion de l'eau",
            "Entreprise de fabrication de jouets",
            "Entreprise de fabrication de produits pharmaceutiques",
            "Entreprise de gestion des médias sociaux",
            "Entreprise de gestion des déchets électroniques",
            "Entreprise de fabrication de vêtements de sport",
            "Entreprise de production cinématographique",
            "Entreprise de production de musique",
            "Entreprise de production de jeux vidéo",
            "Entreprise de conception de logiciels de gestion",
            "Entreprise de gestion de la chaîne d'approvisionnement",
        ];


        foreach ($jobGrades as $value) {
            $jobGrade = new JobGrade();
            $jobGrade->setTitle($value);
            $manager->persist($jobGrade);
        }
        foreach ($jobTypes as $value) {
            $jobType = new JobType();
            $jobType->setTitle($value);
            $manager->persist($jobType);
        }
        foreach ($genders as $value) {
            $genders = new Gender();
            $genders->setTitle($value);
            $manager->persist($genders);
        }
        foreach ($companySizes as $value) {
            $companySize = new CompanySize();
            $companySize->setSize($value);
            $manager->persist($companySize);
        }
        foreach ($domains as $value) {
            $domain = new Domain();
            $domain->setTitle($value);
            $manager->persist($domain);
        }
        foreach ($companyTypes as $value) {
            $companyType = new CompanyType();
            $companyType->setType($value);
            $manager->persist($companyType);
        }

        $manager->flush();
    }
}
