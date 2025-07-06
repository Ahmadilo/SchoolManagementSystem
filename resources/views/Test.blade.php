<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <script>
        const person = {
        user_id: 2,
        first_name: "John",
        last_name: "Doe",
        date_of_birth: "1990-01-01",
        gender: "male",
        email: "john.doe@example.com",
        phone: "123-456-7890",
        address: "123 Main St, Anytown, USA"
        };
        const apiUrl = 'http://localhost:8000/api/person'; // عدّل المسار حسب السيرفر عندك

        fetch(apiUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                // إذا كنت تستخدم Laravel Sanctum أو Token Authentication، أضف Authorization هنا
                // 'Authorization': 'Bearer YOUR_ACCESS_TOKEN'
            },
            body: JSON.stringify(person)
            })
            .then(response => {
                if (!response.ok) {
                    // استخراج الأخطاء من JSON
                    return response.json().then(err => { throw err; });
                }
                return response.json();
            })
            .then(data => {
                console.log('✅ تم إنشاء المستخدم بنجاح:', data);
            })
            .catch(error => {
                console.error('❌ حدث خطأ أثناء إنشاء المستخدم:', error);
            });
    </script>

    <script>
        fetch('http://localhost:8000/api/person', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                // 'Authorization': 'Bearer YOUR_ACCESS_TOKEN'
            }
        })
        .then(response => {
            if (!response.ok) {
                // استخراج الأخطاء من JSON
                return response.json().then(err => { throw err; });
            }
            return response.json();
        })
        .then(data => {
            console.log('✅ تم استرجاع الأشخاص بنجاح:', data);
        })
        .catch(error => {
            console.error('❌ حدث خطأ أثناء استرجاع الأشخاص:', error);
        });
    </script>

</body>
</html>
