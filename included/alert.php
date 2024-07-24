<?php
// $_SESSION["alert"] = "Stuff";
if (isset($_SESSION["alert"])) {
?>
    <script>
        demo.showNotification('top', 'right', '<?= $_SESSION["alert"] ?>')
    </script>
<?php
    unset($_SESSION["alert"]);
}
?>