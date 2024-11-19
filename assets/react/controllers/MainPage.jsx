import React, { StrictMode } from 'react';

const MainPage = ({ lastBraindump }) => {
    console.log(lastBraindump);
    return (
        <StrictMode>
            <div>
                <div className="card">
                    <div className="card-header">
                        <h2 className="card-title">{lastBraindump.name}</h2>
                    </div>
                    <div className="card-body">
                        <div dangerouslySetInnerHTML={{ __html: lastBraindump.dump }} />
                    </div>
                </div>
                <div className="card">
                    <div className="card-header">
                        <h2 className="card-title">Making something from nothing</h2>
                    </div>
                    <div className="card-body">
                        <ol>
                            <li>
                                2,000 USD Target
                                <ol>
                                    <li>Freelancing profiles</li>
                                    <li>Getting the money</li>
                                </ol>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </StrictMode>
    );
};

export default MainPage;
