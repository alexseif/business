import React, { useEffect, useState } from 'react';

const Braindumps = () => {
    const [braindumps, setBraindumps] = useState([]);

    useEffect(() => {
        const fetchBraindumps = async () => {
            const response = await fetch('/api/braindumps');
            const data = await response.json();
            setBraindumps(data);
        };

        fetchBraindumps();
    }, []);

    return (
        <div>
            {braindumps.map(braindump => (
                <div key={braindump.id} className="card">
                    <div className="card-header">
                        <h2 className="card-title">{braindump.name}</h2>
                    </div>
                    <div className="card-body">
                        <div dangerouslySetInnerHTML={{ __html: braindump.dump }} />
                    </div>
                </div>
            ))}
        </div>
    );
};

export default Braindumps;
