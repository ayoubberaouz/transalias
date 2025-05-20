<?php

namespace App\Repositories;

use App\Models\Attendance;
use Carbon\Carbon;
use Amenadiel\JpGraph\Plot;
use Amenadiel\JpGraph\Graph;

/**
 * Class DashboardRepository
 * @package App\Repositories
 * @version July 26, 2021, 12:17 pm UTC
 */

class DashboardRepository
{
    /** @var  UserRepository */
    private $userRepository;
    /** @var  RoleRepository */
    private $roleRepository;
    /** @var  PermissionRepository */
    private $permissionRepository;
    /** @var  AttendanceRepository */
    private $attendanceRepository;

    private $dossiersRepository;
    private $facturesDossierRepository;
    private $noteDebitDossierRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(RoleRepository $roleRepo, UserRepository $userRepo, PermissionRepository $permissionRepo, AttendanceRepository $attendanceRepo,
        DossiersRepository $dossiersRepo, FacturesDossierRepository $facturesDossierRepo, NoteDebitDossierRepository $noteDebitDossierRepo)
    {
        $this->permissionRepository = $permissionRepo;
        $this->userRepository = $userRepo;
        $this->roleRepository = $roleRepo;
        $this->attendanceRepository = $attendanceRepo;
        $this->dossiersRepository = $dossiersRepo;
        $this->facturesDossierRepository = $facturesDossierRepo;
        $this->noteDebitDossierRepository = $noteDebitDossierRepo;
    }

    private function getDashboardInfo()
    {
        $dashboardInfo = [];

        // First Cards
        $dashboardInfo['dossier_count'] =  $this->dossiersRepository->count();
        $dashboardInfo['facture_count'] =  $this->facturesDossierRepository->count();
        $dashboardInfo['note_count'] =  $this->noteDebitDossierRepository->count();

        // Chart Dossier
        $dashboardInfo['dossier'] = $this->dossiersRepository->getDateDossierForDashboard()->get();

        $months = [
            'Janvier' => 0, 'Février' => 1, 'Mars' => 2, 'Avril' => 3, 'Mai' => 4, 'Juin' => 5,
            'Juillet' => 6, 'Août' => 7, 'Septembre' => 8, 'Octobre' => 9, 'Novembre' => 10, 'Décembre' => 11
        ];
        
        $newDossiers = array_fill(0, 12, 0); // Initialize array with 12 zeros
        $closedDossiers = array_fill(0, 12, 0); // Initialize array with 12 zeros
        
        foreach ($dashboardInfo['dossier'] as $dossier) {
            $date = $dossier->date_insertion;
            $monthIndex = (int) $date->format('n') - 1; // Get month index (0-11)
            
            if ($dossier->etat_cloture == 0) {
                $newDossiers[$monthIndex]++;
            } elseif ($dossier->etat_cloture == 1) {
                $closedDossiers[$monthIndex]++;
            }
        }
        
        $dashboardInfo['newDossiers'] = json_encode($newDossiers);
        $dashboardInfo['closedDossiers'] = json_encode($closedDossiers);

        // Chart FacturesDossier
        $dashboardInfo['facturesDossier'] = $this->facturesDossierRepository->getDateFactureForDashboard()->get();
        
        $paidFactures = array_fill(0, 12, 0); // Initialize array with 12 zeros
        $unpaidFactures = array_fill(0, 12, 0); // Initialize array with 12 zeros
        
        foreach ($dashboardInfo['facturesDossier'] as $facturesDossier) {
            $date = $facturesDossier->dateInsertion;
            $monthIndex = (int) $date->format('n') - 1; // Get month index (0-11)
            
            if ($facturesDossier->etat_paiement == 'Oui') {
                $paidFactures[$monthIndex]++;
            } elseif ($facturesDossier->etat_paiement == 'Non') {
                $unpaidFactures[$monthIndex]++;
            }
        }
        
        $dashboardInfo['paidFactures'] = json_encode($paidFactures);
        $dashboardInfo['unpaidFactures'] = json_encode($unpaidFactures);

        // Chart NoteDebitDossier
        $dashboardInfo['noteDebitDossier'] = $this->noteDebitDossierRepository->getDateNoteDebitForDashboard()->get();
        
        $paidNotesDebit = array_fill(0, 12, 0); // Initialize array with 12 zeros
        $unpaidNotesDebit = array_fill(0, 12, 0); // Initialize array with 12 zeros
        
        foreach ($dashboardInfo['noteDebitDossier'] as $noteDebitDossier) {
            $date = $noteDebitDossier->dateinsertion;
            $monthIndex = (int) $date->format('n') - 1; // Get month index (0-11)
            
            if ($noteDebitDossier->etat_paiement == 'Oui') {
                $paidNotesDebit[$monthIndex]++;
            } elseif ($noteDebitDossier->etat_paiement == 'Non') {
                $unpaidNotesDebit[$monthIndex]++;
            }
        }
        
        $dashboardInfo['paidNotesDebit'] = json_encode($paidNotesDebit);
        $dashboardInfo['unpaidNotesDebit'] = json_encode($unpaidNotesDebit);

        return $dashboardInfo;
    }

    private function getChartUserCheckinInfo()
    {
        $labels = [];
        $dataset1 = [];
        $dataset1['label'] = 'My Daily';
        $dataset1['data'] = [];
        $dataset1['borderColor'] = 'rgb(75, 192, 192)';

        $data = $this->attendanceRepository->TotalCheckInByDay(auth()->user()->id);
        foreach ($data as $key => $value) {
            $dataset1['data'][$key] = $value;
            $labels[$key] = $key;
        }

        $dataset2 = [];
        $dataset2['label'] = 'User Daily';
        $dataset2['data'] = [];
        $dataset2['borderColor'] = 'rgb(20, 150, 192)';

        $data = $this->attendanceRepository->TotalCheckInByDay();
        foreach ($data as $key => $value) {
            $dataset2['data'][$key ] = $value;
            $labels[$key] = $key;
        }

        $datasets = [];
        $datasets[] = $dataset1;
        $datasets[] = $dataset2;

        $data = [];
        $data['labels'] = array_values($labels);
        $data['datasets'] = $datasets;

        $chart = [];
        $chart['type'] = 'line';
        $chart['data'] = $data;
        return $chart;
    }

    public function GetData()
    {
        $dashboard = [];
        $dashboard['dashboardInfo'] = $this->getDashboardInfo();
        $dashboard['chartUserCheckin'] = $this->getChartUserCheckinInfo();
        return $dashboard;
    }
}
