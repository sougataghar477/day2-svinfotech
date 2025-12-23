<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: /login/");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>PHP App</title>
  <link rel="stylesheet" href="../styles/output.css"/>
</head>

<body>
<?php
$conn = new mysqli(
    "db.fr-pari1.bengt.wasmernet.com",
    "a890400970b4800092c62a05eeea",
    "0694a890-4009-71fc-8000-31acc0d66b54",
    "userfeedbacks",
    10272
);

 
 

    if ($conn->connect_error) {
        echo json_encode(["status" => "error", "message" => $conn->connect_error]);
        exit;
    }
    
    else{
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
        $deleteId = (int) $_POST['delete_id'];

        $stmt = $conn->prepare("DELETE FROM feedbacks WHERE id = ?");
        $stmt->bind_param("i", $deleteId);
        $stmt->execute();
        $stmt->close();
    }
        
         
        $result = $conn->query("SELECT * FROM feedbacks");
        $data = [];
        while ($row = $result->fetch_assoc()) {
            array_push($data, $row);
        }
        
        $searchQuery = isset($_GET['query']) ? trim($_GET['query']) : '';
        $feedbacks = '';
        
        
        if ($searchQuery !== "") {
            
            $filtered_data = array_filter($data,function($feedback){
                $searchQuery = isset($_GET['query']) ? trim($_GET['query']) : '';
                if(str_contains(strtolower($feedback['email']), strtolower($searchQuery)) 
                    || 
                   str_contains(strtolower($feedback['subject']), strtolower($searchQuery))){
                    return $feedback;
                }
            });
            if(count($filtered_data)>0){
                foreach ($filtered_data as $feedback){
                    $feedbacks .='
                        <tr>
                        <td class="border border-gray-300 px-4 py-2">'.$feedback['id'].'</td>
                        <td class="border border-gray-300 px-4 py-2">'.$feedback['email'].'</td>
                        <td class="border border-gray-300 px-4 py-2">'.$feedback['subject'].'</td>
                        <td class="border border-gray-300 px-4 py-2">'.$feedback['message'].'</td>
                        <td class="border border-gray-300 px-4 py-2">'.$feedback['created_at'].'</td>
                        <td class="border border-gray-300 px-4 py-2">
                            <form method="POST" onsubmit="return confirm(\'Delete this feedback?\')">
                                <input type="hidden" name="delete_id" value="'.$feedback['id'].'">
                                <button type="submit" class="text-red-600 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                    ';
                }
            }
            else{
                $feedbacks = '<tr>
                    <td colspan="6" class="text-center py-4 text-gray-600">
                        No feedbacks found.
                    </td>
                </tr>';
            }
        } 
        else {
            foreach ($data as $feedback) {
                $feedbacks .= '<tr>
                    <td class="border border-gray-300 px-4 py-2">'.$feedback['id'].'</td>
                    <td class="border border-gray-300 px-4 py-2">'.$feedback['email'].'</td>
                    <td class="border border-gray-300 px-4 py-2">'.$feedback['subject'].'</td>
                    <td class="border border-gray-300 px-4 py-2">'.$feedback['message'].'</td>
                    <td class="border border-gray-300 px-4 py-2">'.$feedback['submitted_at'].'</td>
                    <td class="border border-gray-300 px-4 py-2">
                        <form method="POST" onsubmit="return confirm(\'Delete this feedback?\')">
                            <input type="hidden" name="delete_id" value="'.$feedback['id'].'">
                            <button type="submit" class="text-red-600 hover:underline">Delete</button>
                        </form>
                    </td>
                </tr>';
            }
        }
        
        $html = '
        <div class="w-full">
            
         
            <form method="GET">
                <input
                    id="adminSearch"
                    name="query"
                    class="w-full border border-gray-300 p-4 rounded-2xl mb-4"
                    type="search"
                    placeholder="Search by Email or Subject"
                    value="'.htmlspecialchars($searchQuery).'"
                />
                <button type="submit" class="bg-black text-white px-4 py-2 mb-4 rounded-xl">Search</button>
            </form>
                <form method="GET">
                <input
                    id="adminSearch"
                    name="query"
                    class="w-full border border-gray-300 p-4 rounded-2xl mb-4"
                    type="hidden"
                    value=""
                />
                <button type="submit" class="bg-black text-white px-4 py-2 mb-4 rounded-xl">Clear Search</button>
            </form>
        
            <table class="w-full shadow-2xl p-4 border border-gray-300 border-collapse overflow-hidden">
                <tr>
                    <th class="border border-gray-300 px-4 py-2">Id</th>
                    <th class="border border-gray-300 px-4 py-2">Email</th>
                    <th class="border border-gray-300 px-4 py-2">Subject</th>
                    <th class="border border-gray-300 px-4 py-2">Message</th>
                    <th class="border border-gray-300 px-4 py-2">Submitted At</th>
                    <th class="border border-gray-300 px-4 py-2">Actions</th>
                </tr>
                '.$feedbacks.'
            </table>
        </div>
        ';
    }
 

include "../container.php";
?>

<script src="../scripts/main.js"></script>
</body>
</html>
