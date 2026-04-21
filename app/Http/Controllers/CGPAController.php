<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CGPAController extends Controller
{
    public function index()
    {
        return view('cgpa');
    }

    public function about()
    {
        return view('about');
    }

    public function help()
    {
        return view('help');
    }

    public function calculate(Request $request)
    {
        $units = $request->units;
        $grades = $request->grades;

        $gradePoints = [
            'A' => 5,
            'B' => 4,
            'C' => 3,
            'D' => 2,
            'E' => 1,
            'F' => 0
        ];

        $totalPoints = 0;
        $totalUnits = 0;
        $courseCount = 0;

        for ($i = 0; $i < count($units); $i++) {
            if (!empty($units[$i]) && isset($grades[$i])) {
                $point = $gradePoints[$grades[$i]];
                $totalPoints += $point * $units[$i];
                $totalUnits += $units[$i];
                $courseCount++;
            }
        }

        $cgpa = $totalUnits ? $totalPoints / $totalUnits : 0;

        // Determine class classification
        $classification = $this->getClassification($cgpa);

        return view('cgpa', [
            'cgpa' => round($cgpa, 2),
            'class' => $classification['name'],
            'classClass' => $classification['cssClass'],
            'totalUnits' => $totalUnits,
            'totalPoints' => $totalPoints,
            'courseCount' => $courseCount
        ]);
    }

    private function getClassification($cgpa)
    {
        if ($cgpa >= 4.50) {
            return ['name' => '🏆 First Class Honours', 'cssClass' => 'class-first'];
        } elseif ($cgpa >= 3.50) {
            return ['name' => '🥈 Second Class Upper', 'cssClass' => 'class-second-upper'];
        } elseif ($cgpa >= 2.50) {
            return ['name' => '🥉 Second Class Lower', 'cssClass' => 'class-second-lower'];
        } elseif ($cgpa >= 1.50) {
            return ['name' => 'Third Class', 'cssClass' => 'class-third'];
        } elseif ($cgpa >= 1.00) {
            return ['name' => 'Pass', 'cssClass' => 'class-pass'];
        } else {
            return ['name' => '❌ Fail', 'cssClass' => 'class-fail'];
        }
    }
}
